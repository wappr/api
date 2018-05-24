<?php

namespace App\Http\Controllers;

use App\User;
use \Firebase\JWT\JWT;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Authenticate user based on their email address and password. Then, if
     * they supplied the correct credentials, create a JWT and send it to
     * them. If they sent bad credentials, then return an error with
     * a 403 response.
     *
     * @param  Request $request
     *
     * @return \Illuminate\Http\Response;
     */
    public function authenticate(Request $request)
	{
        // First we need to find the user by the email address submitted
		$user = User::where('email', $request->email)->first();

        // If no user exists with that email address, return a 403 response
		if(!$user) {
			return response()->json(['error' => 'Not authorized'], 403);
		}

        // If the passwords don't match, return a 403 response
		if(!Hash::check($request->password, $user->password)) {
			return response()->json(['error' => 'Not authorized'], 403);
		}

        // User must be who they say they are. Create a JWT with some basic
        // information and return it with a status of success.
		return [
			'token' => JWT::encode([
				'sub' => $user->id,
				'name' => $user->name,
				'email' => $user->email,
                'iat' => time(),
				'exp' => strtotime('today + 7 days')
			], env('JWT_SECRET')),
            'status' => 'success'
		];
	}
}
