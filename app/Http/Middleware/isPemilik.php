<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class isPemilik
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        //ambil role dari session atau dari relasi user
        $userRole = session('user_role');

        //jika user terautentifikasi tapi role 1, return 403
        if ($userRole === 5) { 
            return $next($request);
        } else {
            return back()->with('error', 'Akses ditolak Anda tidak memiliki izin untuk mengakses halaman ini.');
        }
    }
}
