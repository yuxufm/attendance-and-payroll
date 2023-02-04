<?php

namespace App\Http\Middleware;

use App\Helpers\PegawaiHelpers;
use Closure;
use Illuminate\Http\Request;

class PegawaiAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $pegawai = new PegawaiHelpers;
        if ($pegawai->isLoggedIn() === true) {
            return $next($request);
        }

        return redirect('pegawai/login');
    }
}
