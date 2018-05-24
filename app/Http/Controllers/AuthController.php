<?php

namespace App\Http\Controllers;

use App\User;
use \Firebase\JWT\JWT;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function authenticate(Request $request)
	{
		$user = User::where('email', $request->email)->first();
		if(!$user) {
			return response()->json(['error' => 'Not authorized'], 403);
		}

		if(!Hash::check($request->password, $user->password)) {
			return response()->json(['error' => 'Not authorized'], 403);
		}

		return [
			'token' => JWT::encode([
				'sub' => $user->id,
				'name' => $user->name,
				'email' => $user->email,
				'iat' => strtotime('today + 7 days')
			], env('JWT_SECRET')),
            'status' => 'success'
		];
	}
}
