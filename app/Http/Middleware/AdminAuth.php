<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminAuth
{
    public function handle(Request $request, Closure $next)
    {
        // ❗ cek SESSION, bukan auth()
        if (!session()->has('admin_username')) {
            return redirect()->route('admin.login');
        }

        return $next($request);
    }
}
