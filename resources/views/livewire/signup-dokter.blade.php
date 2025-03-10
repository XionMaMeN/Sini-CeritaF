<div>
    @if (!empty($successMessage))
        <div class="alert alert-success">
            {{ $successMessage }}
        </div>
    @endif
    <div class="flex flex-col">
        <div class="flex items-center justify-around">
            <div class="flex items-center gap-2">
                <a class="btn btn-circle {{ $currentStep != 1 ? 'btn bg-white hover:bg-white text-hitam-800 hover:text-hitam-800 border-biru-6 hover:border-biru-6' : 'btn bg-biru-6 hover:bg-biru-6  hover:text-white text-white border-none' }}"
                    type="button" href="#step-1">1</a>
                <p class="text-hitam-800">Biodata</p>
            </div>
            <div class="flex items-center gap-2">
                <a class="btn btn-circle {{ $currentStep != 2 ? 'btn bg-white hover:bg-white text-hitam-800 hover:text-hitam-800 border-biru-6 hover:border-biru-6' : 'btn bg-biru-6 hover:bg-biru-6  hover:text-white text-white border-none' }}"
                    type="button" href="#step-2">2</a>
                <p class="text-hitam-800">Dokumen Kedokteran</p>
            </div>
            <div class="flex items-center gap-2">
                <a class="btn btn-circle {{ $currentStep != 3 ? 'btn bg-white hover:bg-white text-hitam-800 hover:text-hitam-800 border-biru-6 hover:border-biru-6' : 'btn bg-biru-6 hover:bg-biru-6  hover:text-white text-white border-none' }}"
                    type="button" href="#step-3" disabled="disabled">3</a>
                <p class="text-hitam-800">Submit</p>
            </div>
        </div>

        <div class="{{ $currentStep != 1 ? 'hidden' : '' }} py-4 grid gap-3 setup-content" id="step-1">
            <h1 class="text-2xl font-bold text-center text-hitam-800">Step 1 - Biodata</h1>
            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                <div>
                    <label class="label label-text text-hitam-800" for="nama_lengkap">Nama Lengkap </label>
                    <input id="nama_lengkap" type="text" name="nama_lengkap" wire:model="nama_lengkap"
                        placeholder="Noel Gallagher" class="bg-white input text-hitam-800 focus:border-biru-6"
                        required />
                </div>
                <div>
                    <label class="label label-text text-hitam-800" for="tanggal_lahir">Tanggal Lahir</label>
                    <input type="text" wire:model="tanggal_lahir"
                        class="bg-white text-hitam-800 input focus:border-biru-6" placeholder="Januari 01, 2025"
                        id="tanggal_lahir" name="tanggal_lahir" required />
                </div>
                <div>
                    <label class="label label-text text-hitam-800" for="alamat">Alamat Lengkap</label>
                    <input id="alamat" wire:model="alamat" type="text" name="alamat" placeholder="Alamat lengkap"
                        class="bg-white input text-hitam-800 focus:border-biru-6" required />
                </div>
                <div>
                    <label class="label label-text text-hitam-800" for="email">Email</label>
                    <input id="email" wire:model="email" type="email" name="email" placeholder="email@gmail.com"
                        class="bg-white input text-hitam-800 focus:border-biru-6" required />
                </div>
                <div>
                    <div class="label label-text text-hitam-800">Jenis Kelamin</div>
                    <div class="flex items-center gap-4">
                        <div class="flex items-center gap-1">
                            <input type="radio" id="pria" wire:model="jenis_kelamin" value="Pria"
                                class="bg-white radio radio-info" required />
                            <label class="text-base text-hitam-800 label label-text" for="pria">Pria</label>
                        </div>
                        <div class="flex items-center gap-1">
                            <input type="radio" id="wanita" wire:model="jenis_kelamin" value="Wanita"
                                class="bg-white radio radio-info" required />
                            <label class="text-base label label-text text-hitam-800" for="wanita">Wanita</label>
                        </div>
                    </div>
                </div>
                <div>
                    <label class="label label-text text-hitam-800" for="password">Password</label>
                    <div class="relative flex items-center w-full">
                        <input id="toggle-password" name="password" wire:model="password" type="password" id="password"
                            class="bg-white input text-hitam-800 focus:border-biru-6" placeholder="Enter password" />
                        <span class="absolute right-2">
                            <button type="button" data-toggle-password='{ "target": "#toggle-password" }'
                                class="block" aria-label="password toggle">
                                <span
                                    class="icon-[tabler--eye] text-base-content/80 password-active:block hidden size-5 flex-shrink-0"></span>
                                <span
                                    class="icon-[tabler--eye-off] text-base-content/80 password-active:hidden block size-5 flex-shrink-0"></span>
                            </button>
                        </span>
                    </div>
                </div>
                <div>
                    <label class="label label-text text-hitam-800" for="no_telp">Nomor Telepon</label>
                    <input id="no_telp" wire:model="no_telp" type="no_telp" name="no_telp" placeholder="081122223333"
                        class="bg-white input text-hitam-800 focus:border-biru-6" required />
                </div>
                <div>
                    <label class="label label-text text-hitam-800" for="foto_profil">Foto Profil</label>
                    <input id="foto_profil" wire:model="foto_profil" name="foto_profil" type="file"
                        class="bg-white border input text-hitam-800" required />
                </div>
                <div>
                    <label class="label label-text text-hitam-800" for="foto_wajah">Foto Wajah</label>
                    <input id="foto_wajah" wire:model="foto_wajah" name="foto_wajah" type="file"
                        class="bg-white border input text-hitam-800" required />
                </div>
                <div>
                    <label class="label label-text text-hitam-800" for="foto_ktp">Foto KTP</label>
                    <input id="foto_ktp" wire:model="foto_ktp" name="foto_ktp" type="file"
                        class="bg-white border input text-hitam-800" required />
                </div>
            </div>
            <button class="text-white border-none btn bg-biru-6 hover:bg-biru-5" wire:click="firstStepSubmit"
                type="button">Next</button>
        </div>
    </div>

    <div class="{{ $currentStep != 2 ? 'hidden' : '' }} py-4 setup-content" id="step-2">
        <h1 class="text-2xl font-bold text-center text-hitam-800">Step 2 - Dokumen Kedokteran</h1>
        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
            <div>
                <label class="label label-text text-hitam-800" for="foto_strpk">Foto STRPK</label>
                <input id="foto_strpk" wire:model="foto_strpk" name="foto_strpk" wire:model="foto_strpk"
                    type="file" class="bg-white border input text-hitam-800" required />
            </div>
            <div>
                <label class="label label-text text-hitam-800" for="no_strpk">Nomor STRPK</label>
                <input id="no_strpk" wire:model="no_strpk" type="no_strpk" name="no_strpk" placeholder="No. STRPK"
                    class="bg-white input text-hitam-800 focus:border-biru-6" required />
            </div>
            <div>
                <label class="label label-text text-hitam-800" for="foto_sippk">Foto SIPPK</label>
                <input id="foto_sippk" name="foto_sippk" wire:model="foto_sippk" wire:model="foto_sippk"
                    type="file" class="bg-white border input text-hitam-800" required />
            </div>
            <div>
                <label class="label label-text text-hitam-800" for="no_sippk">Nomor SIPPK</label>
                <input id="no_sippk" wire:model="no_sippk" type="no_sippk" name="no_sippk" placeholder="No. STRPK"
                    class="bg-white input text-hitam-800 focus:border-biru-6" required />
            </div>
        </div>
        <div class="items-center justify-between w-full mt-3">
            <button class="btn btn-danger pull-right" type="button" wire:click="back(1)">Back</button>
            <button class="text-white border-none btn bg-biru-6 hover:bg-biru-5" wire:click="secondStepSubmit"
                type="button">Next</button>
        </div>
    </div>

    <div class="{{ $currentStep != 3 ? 'hidden' : '' }} py-4" id="step-3">
        <h1 class="text-2xl font-bold text-center text-hitam-800">Step 3 - Periksa Data</h1>
        <div class="grid w-full grid-cols-2 mt-4 gap-y-3 place-items-center">
            <div class="w-full grid place-items-start grid-cols-[150px,1fr]">
                <h4 class="text-hitam-800">Nama lengkap</h4>
                <p class="text-hitam-800">: {{ $nama_lengkap }}</p>
            </div>
            <div class="w-full grid place-items-start grid-cols-[150px,1fr]">
                <h4 class="text-hitam-800">Tanggal lahir</h4>
                <p class="text-hitam-800">: {{ $tanggal_lahir }}</p>
            </div>
            <div class="w-full grid place-items-start grid-cols-[150px,1fr]">
                <h4 class="text-hitam-800">Jenis kelamin</h4>
                <p class="text-hitam-800">: {{ $jenis_kelamin }}</p>
            </div>
            <div class="w-full grid place-items-start grid-cols-[150px,1fr]">
                <h4 class="text-hitam-800">Alamat</h4>
                <p class="text-hitam-800">: {{ $alamat }}</p>
            </div>
            <div class="w-full grid place-items-start grid-cols-[150px,1fr]">
                <h4 class="text-hitam-800">Email</h4>
                <p class="text-hitam-800">: {{ $email }}</p>
            </div>
            <div class="w-full grid place-items-start grid-cols-[150px,1fr]">
                <h4 class="text-hitam-800">No. Telepon</h4>
                <p class="text-hitam-800">: {{ $no_telp }}</p>
            </div>
            <div class="w-full grid place-items-start grid-cols-[150px,1fr]">
                <h4 class="text-hitam-800">Foto Profil</h4>
                <p class="text-hitam-800">: @if ($foto_profil)
                        <a href="{{ $foto_profil->temporaryUrl() }}" target="_blank" class="underline">Foto
                            Profil</a>
                    @endif
                </p>
            </div>
            <div class="w-full grid place-items-start grid-cols-[150px,1fr]">
                <h4 class="text-hitam-800">Foto Wajah</h4>
                <p class="text-hitam-800">: <a href=""></a></p>
            </div>
            <div class="w-full grid place-items-start grid-cols-[150px,1fr]">
                <h4 class="text-hitam-800">Foto KTP</h4>
                <p class="text-hitam-800">: <a href=""></a></p>
            </div>
            <div class="w-full grid place-items-start grid-cols-[150px,1fr]">
                <h4 class="text-hitam-800">Foto STRPK</h4>
                <p class="text-hitam-800">: <a href=""></a></p>
            </div>
            <div class="w-full grid place-items-start grid-cols-[150px,1fr]">
                <h4 class="text-hitam-800">Nomor STRPK</h4>
                <p class="text-hitam-800">: {{ $no_strpk }}</p>
            </div>
            <div class="w-full grid place-items-start grid-cols-[150px,1fr]">
                <h4 class="text-hitam-800">Foto SIPPK</h4>
                <p class="text-hitam-800">: <a href=""></a></p>
            </div>
            <div class="w-full grid place-items-start grid-cols-[150px,1fr]">
                <h4 class="text-hitam-800">Nomor SIPPK</h4>
                <p class="text-hitam-800">: {{ $no_sippk }}</p>
            </div>
        </div>
        <div class="w-full flex items-center justify-between mt-4">
            <button class="btn btn-danger nextBtn btn-lg pull-right" type="button"
                wire:click="back(2)">Kembali</button>
            <button class="btn btn-success btn-lg pull-right" wire:click="submitForm" type="button">Submit</button>
        </div>
    </div>
</div>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        flatpickr("#tanggal_lahir", {
            altInput: true,
            altFormat: 'F j, Y',
            dateFormat: 'Y-m-d'
        });
    });
</script>
