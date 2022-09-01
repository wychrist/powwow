<?php

namespace App\Actions\OnlineContact;

use App\Models\OnlineContact;
use Illuminate\Support\Facades\Validator;
use Modules\CongregateEmailValidator\EmailValidator;
use Modules\CongregateEmailValidator\ValidatorResult;

/**
 * Handles a new contact request
 */
class HandleNewContact
{
    /**
     * Handles a new contact request
     *
     * Validates data and passes it on to the email validator in order
     * to validate the provided email
     *
     * The return value is an array that contains the validation token
     * and url
     *
     * @param array $payload ['email' => string, 'type' => string, 'data' => array ]
     *
     * @return array ['token' => string , 'url' => string ]
     */
    public function __invoke(array $payload): ValidatorResult
    {
        $data = Validator::make($payload, [
                'email' => ['required', 'string', 'email', 'max:255'],
                'type' => ['required', 'string', 'max:255'],
                'data'  => ['required', 'array']
            ]
        )->validate();

        ['email' => $email] = $data;

        $existing = OnlineContact::where([
            'email' => $email
        ])->first();

        if($existing) {
            return new ValidatorResult('', true, '');
        }

        return EmailValidator::register($email, [AddContactEntry::class, 'execute'], $data);
    }
}
