<?php

namespace App\Http\Controllers;

use App\Actions\Newsletter\HandleNewSubscription;
use App\Actions\Newsletter\SendSubscriptionValidationEmail;
use Illuminate\Http\Request;
use Modules\CongregateContract\Theme\FlashMessageInterface;

class NewsletterController extends Controller
{

    /**
     * Handle posted data
     */
    public function handleAction(Request $request, HandleNewSubscription $handler, SendSubscriptionValidationEmail $sendEmail, FlashMessageInterface $flash)
    {
        $data = $request->post();

        $turnstileToken = $request->post('cf-turnstile-response');
        $turnstileIP = $request->post('CF-Connecting-IP');
        $result = $this->turnstileValidate($turnstileToken, $turnstileIP);

        if (isset($result['success']) && $result['success']) {
            ['email' => $email] = $this->validate($request, [
                'email' => ['required', 'string', 'email', 'max:255'],
            ]);
            $result = $handler($email, $request->user() ? $request->user()->id : 0);
            $sendEmail($result, $data);
        }


        $message = __('app.subscription_confirm');

        if ($request->isJson()) {
            return [
                'success' => true,
                'message' => $message
            ];
        }

        $flash->success($message);
        return back();
    }


    private function turnstileValidate($token, $remoteAddr)
    {
        $url = env('TURNSTILE_URL');
        $data = [
            "secret" => env('TURNSTILE_SITE_SECRET'),
            "response" => $token,
            "remoteip" => $remoteAddr
        ];

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($curl);

        $response = json_decode($response, true);

        return $response;
    }
}
