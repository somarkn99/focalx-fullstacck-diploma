<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CanLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        if (Auth::check() && Auth::user()->ban == true) {
            Auth::logout();
            return response()->json([
                'status' => 'error',
                'message' => 'لإتمام تسجيل الدخول يرجى التواصل مع مسؤول التطبيق للحصول على تصريح الدخول',
            ], 401);
        }
        return $response;
    }
}
