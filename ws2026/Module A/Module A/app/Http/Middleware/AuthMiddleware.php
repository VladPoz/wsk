<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->bearerToken();
        if (!$token) {
            return response()->json(['message' => 'Unauthorized user'], 401);
        }
        $user = User::query()->where('api_token', $token)->first();
        if (!$user) {
            return response()->json(['message' => 'Unauthorized user'], 401);
        }
        auth()->login($user);
        return $next($request);
    }
}
