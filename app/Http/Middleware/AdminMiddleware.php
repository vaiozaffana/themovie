<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Laravel\Sanctum\PersonalAccessToken;
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
        $token = $request->bearerToken();

        if (!$token) {
            return response()->json([
                'status' => 'error',
                'code' => '401',
                'message' => 'Missing bearer token',
            ], 401);
        }

        $accessToken = PersonalAccessToken::findToken($token);

        if (!$accessToken) {
            return response()->json([
                'status' => 'error',
                'code' => '401',
                'message' => 'Invalid or expired token',
            ], 401);
        }

        if ($accessToken->expires_at && $accessToken->expires_at->isPast()) {
            return response()->json([
                'status' => 'error',
                'code' => '401',
                'message' => 'Token has expired',
            ], 401);
        }

        // $user = $accessToken->tokenable;

        if ($request->user()->role !== 'admin') {
            return response()->json(
                [
                    'status' => 'error',
                    'code' => '401',
                    'message' => 'Unauthorized',
                ],
                401
            );
        }

        // auth()->login($user);

        return $next($request);
    }
}
