<?php

namespace App\Http\Middleware;

use App\Helpers\AdminHelpers;
use Closure;
use Illuminate\Http\Request;

class AdminAuth
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
        $admin = new AdminHelpers;
        if ($admin->isLoggedIn() === true) {
            return $next($request);
        }

        return redirect('admin/login');
    }
}
