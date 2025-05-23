<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!session()->has('role_id')) {
            return redirect('/')->with('GuestDetected', 'Silakan login terlebih dahulu!'); // Arahkan ke halaman login
        }

        // Cek apakah user bukan admin
        if (session('role_id') !== 3) {
            abort(404);
        }
        return $next($request);
    }
}
