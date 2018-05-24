<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Log;
use \Firebase\JWT\JWT;
use \Firebase\JWT\SignatureInvalidException;

class CheckToken
{
    /**
     * Check incoming request to see if it has a valid JWT
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // Decoding a bad JWT can result in an exception that we need to handle
        // gracefully. So, if we get a bad token, log it and return a 403.
        // Otherwise move onto the next middleware.
        try {
            $decoded = JWT::decode($request->token, env('JWT_SECRET'), ['HS256']);
        } catch(SignatureInvalidException $e) {
            Log::info('Invalid Signature for JWT in middleware');

            return response()->json(['error' => 'Not authorized'], 403);
        }

        return $next($request);
    }
}
