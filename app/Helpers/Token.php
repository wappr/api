<?php

namespace App\Helpers;

use \Firebase\JWT\JWT;
use \Firebase\JWT\SignatureInvalidException;

class Token
{
    public static function getUserId($jwt)
    {
        try {
            $decoded = JWT::decode($jwt, env('JWT_SECRET'), ['HS256']);
        } catch(SignatureInvalidException $e) {
            Log::info('Invalid Signature for JWT in middleware');

            return false;
        }

        return $decoded->sub;
    }
}
