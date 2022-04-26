<?php

namespace App\Actions\Newsletter;

use App\Mail\Newsletter\ValidateEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Modules\CongregateEmailValidator\EmailValidator;
use Modules\CongregateEmailValidator\ValidatorResult;

class SendSubscriptionValidationEmail
{

    public function __invoke(ValidatorResult $validationResult, array $data)
    {
        ['email' => $email] = Validator::make($data, [
            'email' => ['required', 'string', 'email', 'max:255'],
        ])->validate();

        if (!$validationResult->alreadyExist()) {
            Mail::to($email)->queue(new ValidateEmail(array_merge($data, [
                'url' => $validationResult->getUrl(),
                'token' => $validationResult->getToken()
            ])));
        }
    }
}
