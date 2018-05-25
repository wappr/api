<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

/**
 * Retrieve, and search for contacts
 */
class ContactsController extends Controller
{
    /**
     * Retrieve a user's contacts
     *
     * @todo Redo this to work with Contacts model
     *
     * @param  Request $request
     * @return Response
     */
    public function retrieve(Request $request)
    {
        return User::get(['id', 'name']);
    }

    /**
     * Search for a user by their name
     *
     * @param  Request $request
     * @return Response
     */
    public function search(Request $request)
    {
        return User::where('name', 'like', '%' . $request->keywords . '%')->get();
    }
}
