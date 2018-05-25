<?php

namespace App\Http\Controllers;

use App\ContactRequest;
use Illuminate\Http\Request;
use App\Repositories\ContactsRepository;

class ContactRequestController extends Controller
{
    public function send(Request $request)
    {
        $cr = new ContactRequest;
        $cr->from = $request->from;
        $cr->to = $request->to;

        if($cr->save()) {
            return ['status' => 'success'];
        }

        return ['status' => 'failed'];
    }

    public function accept(Request $request)
    {
        // Delete the request
        $deletedRequests = ContactRequest::where('from', $request->from)->where('to', $request->to)->delete();

        // Add the pals as contacts
        ContactsRepository::create($request->from, $request->to);

        return ['status' => 'success'];
    }
}
