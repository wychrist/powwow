<?php

namespace App\Actions\Newsletter;

use App\Mail\Newsletter\ValidateEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Modules\CongregateEmailValidator\EmailValidator;

class SendSubscriptionValidationEmail
{

    public function __invoke(array $validationResult, array $data)
    {
       ['email' => $email] = Validator::make($data, [
            'email' => ['required', 'string', 'email', 'max:255'],
        ])->validate();

        Mail::to($email)->queue(new ValidateEmail(array_merge($data, $validationResult)));
    }

}
