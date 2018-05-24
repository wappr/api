<?php

namespace App\Http\Controllers;

use App\User;
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

		return 'yes';
	}
}
