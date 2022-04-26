<?php

namespace App\Actions\OnlineContact;

use App\Mail\OnlineContact\ValidateEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Modules\CongregateEmailValidator\ValidatorResult;

class SendContactValidationEmail
{

    public function __invoke(ValidatorResult $validationResult, array $data)
    {
        if (!$validationResult->alreadyExist()) {
            ['email' => $email] = Validator::make($data, [
                'email' => ['required', 'string', 'email', 'max:255'],
            ])->validate();

            Mail::to($email)->queue(new ValidateEmail(array_merge($data, [
                'url' => $validationResult->getUrl(),
                'token' => $validationResult->getToken()
            ])));
        }
    }
}
