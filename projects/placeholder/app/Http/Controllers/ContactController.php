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
            rand(1, 9000),
            rand(1, 13)
        ];
        $numberToString = [
            "one",
            "two",
            "three",
            "four",
            "five",
            "six",
            "seven",
            "eight",
            "nine",
            "ten",
            "eleven",
            "twelve",
            "thirteen"
        ];

        $surfix = $challenge[0] + $challenge[1]; // challenge answer field will be named "challenge_ans_[whatever the answer is]"

        return view('contact.contact_us_form', ['page' => $page, 'challenge' => $challenge, 'challenge_field' => "challenge_ans_$surfix", "number_to_str" => $numberToString]);
    }

    /**
     * Handles posted data
     */
    public function handleAction(Request $request, HandleNewContact $handleNewContact, SendContactValidationEmail $sendEmail, FlashMessageInterface $flash)
    {
        $data = $request->post();
        $challengeAnsField = false;
        $ans = 0;

        if (isset($data['challenge']) && is_array($data['challenge'])) {
            $ans = intval($data['challenge'][0]) + intval($data['challenge'][1]);
            $challengeAnsField = "challenge_ans_{$ans}"; // A prefix wil be added a the time of rendering the form
        }

        if ($challengeAnsField && isset($data[$challengeAnsField]) && intval($data[$challengeAnsField]) == $ans) {

            // Not needed at this stage
            unset($data['challenge']);
            unset($data[$challengeAnsField]);

            $result = $handleNewContact($data);
            if (!$result->alreadyExist()) {
                $sendEmail($result, $data);
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
