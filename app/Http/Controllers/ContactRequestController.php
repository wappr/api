<?php

namespace App\Http\Controllers;

use App\ContactRequest;
use Illuminate\Http\Request;
use App\Repositories\ContactsRepository;

/**
 * Controller for adding new pals
 */
class ContactRequestController extends Controller
{
    /**
     * Send someone a request to be contacts
     *
     * @param  Request $request
     * @return Response
     */
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

    /**
     * Accept a pal request
     * 
     * @param  Request $request
     * @return Response
     */
    public function accept(Request $request)
    {
        // Delete the request
        $deletedRequests = ContactRequest::where('from', $request->from)->where('to', $request->to)->delete();

        // Add the pals as contacts
        ContactsRepository::create($request->from, $request->to);

        return ['status' => 'success'];
    }
}
