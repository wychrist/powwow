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
        $challenge = [
            rand(1, 6000),
            rand(1, 10)
        ];

        return view('contact.contact_us_form', ['page' => $page, 'challenge' => $challenge]);
    }

    /**
     * Handles posted data
     */
    public function handleAction(Request $request, HandleNewContact $handleNewContact, SendContactValidationEmail $sendEmail, FlashMessageInterface $flash)
    {
        $data = $request->post();

        if (isset($data['challenge']) && is_array($data['challenge']) && isset($data['challenge_ans'])) {
            $ans = $data['challenge'][0] + $data['challenge'][1];

            if ($ans == $data['challenge_ans']) {
                unset($data['challenge']);
                unset($data['challenge_ans']);
                $result = $handleNewContact($data);

                if (!$result->alreadyExist()) {
                    $sendEmail($result, $data);
                }
            }
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
