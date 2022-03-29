<?php

namespace App\Actions\OnlineContact;

use App\Mail\OnlineContact\ValidateEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class SendContactValidationEmail
{

    public function __invoke(array $validationResult, array $data)
    {
       ['email' => $email] = Validator::make($data, [
            'email' => ['required', 'string', 'email', 'max:255'],
        ])->validate();

        Mail::to($email)->queue(new ValidateEmail(array_merge($data, $validationResult)));
    }
}
