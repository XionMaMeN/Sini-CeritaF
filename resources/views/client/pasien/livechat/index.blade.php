@extends('layouts.app')

@section('data-page', 'livechat')
@section('data-user-id', $user->id)
@section('data-dokter-id', $dokter->id)

@section('app-content')
    {{-- Debug guard login --}}3

    <div class="container mx-auto py-8">
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-xl font-semibold mb-4">
                @if (auth()->guard('dokter')->check())
                    Pasien: {{ $user->nama_lengkap }}
                @else
                    Dr. {{ $dokter->nama_lengkap }}
                @endif
            </h2>


            <div id="chat-box" class="border rounded p-4 h-96 overflow-y-scroll mb-4 bg-gray-50 space-y-2">
                <!-- Pesan akan ditampilkan di sini secara realtime -->
            </div>

            <form id="chat-form">
                @csrf
                <input type="hidden" name="sesi_chat_id" value="{{ $chat->id }}">
                <input type="hidden" name="user_id" value="{{ $user->id }}">
                <input type="hidden" name="dokter_id" value="{{ $dokter->id }}">
                <input type="hidden" name="sender" value="{{ auth()->guard('dokter')->check() ? 'dokter' : 'user' }}">
                <div class="flex gap-2">
                    <input id="message-input" class="flex-1 border p-2 rounded" type="text" name="message"
                        placeholder="Tulis pesan..." required autocomplete="off" autofocus>
                    <button class="bg-blue-500 text-white px-4 rounded" type="submit">Kirim</button>
                </div>
            </form>

            {{-- Tombol Akhiri Sesi Chat (khusus dokter) --}}
            @if (auth()->guard('dokter')->check())
                <form method="POST" action="{{ route('dokter.endChat', $chat->id) }}" class="mt-4 text-right">
                    @csrf
                    <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 transition">
                        Akhiri Sesi Chat
                    </button>
                </form>
            @endif


        </div>
    </div>
@endsection

@push('scripts')
    <!-- Load Pusher & Axios -->
    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const userId = {{ $user->id }};
            const dokterId = {{ $dokter->id }};
            const sender = "{{ auth()->guard('dokter')->check() ? 'dokter' : 'user' }}";
            const chatBox = document.getElementById('chat-box');
            const initialMessages = @json($messages ?? []);
            const displayedMessages = new Set();
            const pendingMessages = new Map();

            // Pusher setup
            const pusher = new Pusher('{{ env('PUSHER_APP_KEY') }}', {
                cluster: '{{ env('PUSHER_APP_CLUSTER') }}',
                forceTLS: true,
                authEndpoint: '/broadcasting/auth',
                auth: {
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                            'content')
                    }
                }
            });

            const channel = pusher.subscribe(`private-chat.${userId}.${dokterId}`);

            channel.bind('session-ended', function(data) {
                alert("Sesi live chat telah diakhiri.");
                window.location.href =
                    "{{ auth()->guard('dokter')->check() ? route('dokter.notifikasi') : route('app-index') }}";
            });

            channel.bind('pusher:subscription_succeeded', function() {
                console.log(`✅ Terhubung ke private-chat.${userId}.${dokterId}`);
            });

            channel.bind('chat-message-sent', function(data) {
                if (!data.message) return;

                if (data.id && displayedMessages.has(data.id)) return;

                if (data.id) displayedMessages.add(data.id);

                if (data.sender === sender) {
                    const pendingEl = pendingMessages.get(data.message);
                    if (pendingEl) {
                        pendingEl.setAttribute('data-message-id', data.id);
                        pendingEl.querySelector('.message-text').innerText = data.message;
                        pendingEl.querySelector('.message-status')?.remove();
                        pendingMessages.delete(data.message);
                        return;
                    }
                }

                appendMessage(data, data.sender === sender ? 'me' : 'other');
            });

            // Render pesan awal
            initialMessages.forEach(msg => {
                displayedMessages.add(msg.id);
                appendMessage({
                    id: msg.id,
                    message: msg.message,
                    sender: msg.sender
                }, msg.sender === sender ? 'me' : 'other');
            });

            // Fungsi untuk membuat bubble chat
            function appendMessage(data, side = 'other', isTemp = false) {
                const div = document.createElement('div');
                const isFromDokter = data.sender === 'dokter';
                const senderLabel = side === 'me' ? 'Anda' : (isFromDokter ? 'Dokter' : 'Pasien');

                div.className =
                    `flex ${side === 'me' ? 'justify-end' : 'justify-start'} mb-2 opacity-0 transition-opacity duration-300`;
                if (isTemp) div.setAttribute('data-temp', 'true');
                if (data.id) div.setAttribute('data-message-id', data.id);

                div.innerHTML = `
                    <div class="px-4 py-2 rounded-xl max-w-xs ${side === 'me' ? 'bg-blue-500 text-white' : 'bg-gray-200 text-black'}">
                        <strong>${senderLabel}:</strong>
                        <div class="message-text">${data.message}</div>
                        ${isTemp ? '<div class="message-status text-xs text-white/70 mt-1">⌛ Mengirim...</div>' : ''}
                    </div>
                `;

                chatBox.appendChild(div);

                // Animasi fade-in
                setTimeout(() => div.classList.remove('opacity-0'), 10);

                // Scroll otomatis ke bawah
                chatBox.scrollTop = chatBox.scrollHeight;

                return div;
            }

            // Form kirim pesan
            const chatForm = document.getElementById('chat-form');
            if (!chatForm) {
                console.error('❌ Form chat tidak ditemukan');
                return;
            }

            chatForm.addEventListener('submit', function(e) {
                e.preventDefault();

                const formData = new FormData(chatForm);
                const messageText = formData.get('message').trim();

                if (!messageText) return;

                const tempMessage = {
                    sender: sender,
                    message: messageText
                };

                const tempEl = appendMessage(tempMessage, 'me', true);
                pendingMessages.set(messageText, tempEl);

                axios.post('{{ route('chat.send') }}', formData)
                    .then(response => {
                        console.log('✅ Pesan berhasil dikirim:', response.data);
                    })
                    .catch(error => {
                        console.error('❌ Gagal mengirim pesan:', error);
                        alert('Pesan gagal dikirim.');

                        if (pendingMessages.has(messageText)) {
                            pendingMessages.get(messageText).remove();
                            pendingMessages.delete(messageText);
                        }
                    });

                chatForm.reset();
            });
        });
    </script>
@endpush
