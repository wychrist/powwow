<?php

namespace App\Actions\OnlineContact;

use App\Mail\OnlineContact\SendEmailToSecretary;
use App\Models\OnlineContact;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

/**
 * This action actually creates the contact entry
 *
 * Should be called after the email validator validates
 * the person's email
 *
 */
class AddContactEntry
{

    /**
     * Creates a new contact entry
     *
     * This method is mainly call by the email validator
     *
     * @param array $payload ['email' => string, 'type' => string, 'data' => array]
     *
     */
    public static function execute(array $payload)
    {
        Validator::make($payload, [
            'email' => ['required', 'string', 'email', 'max:255'],
            'type' => ['required', 'string', 'max:255'],
            'data' => ['array'],
        ])->validate();

        ['email' => $email, 'type' => $type, 'data' => $data] = $payload;
        $instance = app(__CLASS__);
        $instance($email, $data, $type);
    }

    /**
     * Creates a new contact entry
     *
     * Should be called after the person's email has been validated by the Email validator
     *
     * @return OnlineContact
     */
    public function __invoke(string $email, array $data, string $type = 'general'): OnlineContact
    {
        Validator::make([
            'email' => $email,
            'type' => $type
        ], [
            'email' => ['required', 'string', 'email', 'max:255'],
            'type' => ['required', 'string', 'max:255']
        ])->validate();

        $model = OnlineContact::create([
            'email' => $email,
            'type' => $type,
            'data' => $data
        ]);

        if (config()->get('app.send_new_contact_to_secretary', false)) {
            Mail::to($email)->queue(new SendEmailToSecretary([
                'email' => $email,
                'type' => $type,
                'data' => $data
            ]));
        }

        return $model;
    }
}
