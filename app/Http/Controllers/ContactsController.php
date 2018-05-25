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

    public function search(Request $request)
    {
        return User::where('name', 'like', '%' . $request->keywords . '%')->get();
    }
}
