<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Log;
use \Firebase\JWT\JWT;
use \Firebase\JWT\SignatureInvalidException;

class CheckToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        try {
            $decoded = JWT::decode($request->token, env('JWT_SECRET'), ['HS256']);
        } catch(SignatureInvalidException $e) {
            Log::info('Invalid Signature for JWT in middleware');

            return response()->json(['error' => 'Not authorized'], 403);
        }

        return $next($request);
    }
}
