<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $user = JWTAuth::parseToken()->authenticate();
        
        if (!$user || $user->role !== 'admin') {
            return redirect()->route('home')->withErrors(['error' => 'Anda tidak memiliki akses ke halaman ini.']);
        }

        return $next($request);
    }
}
