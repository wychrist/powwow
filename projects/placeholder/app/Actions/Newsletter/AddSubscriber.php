<?php

namespace App\Actions\Newsletter;

use App\Models\NewsletterSubscriber;
use Illuminate\Support\Facades\Validator;

class AddSubscriber
{

    public static function execute(array $payload)
    {
        Validator::make($payload, [
            'email' => ['required', 'string', 'email', 'max:255'],
            'user_id' => ['integer'],
        ])->validate();

        ['user_id' => $userId, 'email' => $email] = $payload;
        $instance = app(__CLASS__);
        $instance($email, $userId);
    }

    public function __invoke(string $email, int $userId = 0): NewsletterSubscriber
    {
        Validator::make([
            'email' => $email,
        ], [
            'email' => ['required', 'string', 'email', 'max:255'],
        ])->validate();

       if($userId > 0)  {
           $model = NewsletterSubscriber::where([
               'user_id' => $userId
           ])->firstOrNew(['user_id' => $userId]);
       } else {
           $model = NewsletterSubscriber::where([
               'email' => $email
           ])->firstOrNew(['user_id' => $userId]);
       }

       $model->email = $email;

       $model->save();

       return $model;
    }
}
