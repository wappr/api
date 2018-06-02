<?php

namespace App\Http\Middleware;

use Closure;
use App\Helpers\Token;
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
        // Use the Token helper to check if the JWT is valid. If the token isn't
        // valid, go ahead and log it, and return a response with the 403
        // error code indicating the request isn't authorized.
        if(!Token::isValid($request->token)) {
            Log::info('Invalid Signature for JWT in middleware');

            return response()->json(['error' => 'Not authorized'], 403);
        }

        return $next($request);
    }
}
