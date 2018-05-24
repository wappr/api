<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class ContactsController extends Controller
{
    public function retrieve(Request $request)
	{
		return User::get(['id', 'name']);
	}
}
