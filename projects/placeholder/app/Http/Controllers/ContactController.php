<?php

namespace App\Http\Controllers;

use App\Actions\OnlineContact\AddContactEntry;
use App\Actions\OnlineContact\HandleNewContact;
use App\Actions\OnlineContact\SendContactValidationEmail;
use App\Cms\Page;
use Illuminate\Http\Request;
use Modules\CongregateContract\Theme\FlashMessageInterface;

class ContactController extends Controller
{

    public function indexAction(FlashMessageInterface $flash)
    {
        $page = new Page();
        $page->title = "Contact Us";

        return view('contact.contact_us_form', compact('page'));
    }

    /**
     * Handles posted data
     */
    public function handleAction(Request $request, HandleNewContact $handleNewContact, SendContactValidationEmail $sendEmail, FlashMessageInterface $flash)
    {
        $data = $request->post();

        $result = $handleNewContact($data);

        if (!$result->alreadyExist()) {
            $sendEmail($result, $data);
        }

        $message = __('app.contact_request_confirm');

        if ($request->isJson()) {
            return [
                'success' => true,
                'message' => $message
            ];
        }

        $flash->success($message, $data);

        return back();
    }
}
