<?php

namespace App\Http\Controllers;

use App\Actions\OnlineContact\AddContactEntry;
use App\Actions\OnlineContact\HandleNewContact;
use App\Actions\OnlineContact\SendContactValidationEmail;
use App\Cms\Page;
use Illuminate\Http\Request;

class ContactController extends Controller
{

    public function indexAction(Request $request)
    {
        $request->session()->reflash();
        $page = new Page();
        $page->title="Contact Us";

       return view('contact.contact_us_form', compact('page'));
    }

    /**
     * Handles posted data
     */
    public function handleAction(Request $request, HandleNewContact $handleNewContact, SendContactValidationEmail $sendEmail)
    {
        $data = $request->post();

        $result = $handleNewContact($data);
        $sendEmail($result, $data);

        $message = __('app.contact_request_confirm');

        if($request->isJson()) {
            return [
                'success' => true,
                'message' => $message
            ];
        }

        return back()->with('success', $message);
    }

}
