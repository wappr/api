<?php

namespace App\Helpers;

use \Firebase\JWT\JWT;
use \Firebase\JWT\SignatureInvalidException;

class Token
{
    /**
     * Get the User ID from a JWT.
     *
     * @param  string $jwt
     * @return string
     */
    public static function getUserId($jwt)
    {
        $decoded = Token::decode($jwt);

        return $decoded->sub;
    }

    /**
     * Check if a JWT is valid using the env secret.
     *
     * @param  string  $jtw
     * @return boolean
     */
    public static function isValid($jtw)
    {
        if(Token::decode($jwt) == false) {
            return false;
        }

        return true;
    }

    /**
     * Decode a JWT.
     *
     * @param  string $jwt
     * @return JWT
     */
    public static function decode($jwt)
    {
        try {
            $decoded = JWT::decode($jwt, env('JWT_SECRET'), ['HS256']);
        } catch(SignatureInvalidException $e) {
            Log::info('Invalid Signature for JWT in middleware');

            return false;
        }

        return $decoded;
    }

}
