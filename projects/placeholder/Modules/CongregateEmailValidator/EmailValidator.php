<?php

namespace Modules\CongregateEmailValidator;

use Illuminate\Container\Container;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;
use Modules\CongregateEmailValidator\Entities\EmailPending;

class EmailValidator
{
    public static function register(string $email, array $callback, array $payload = []): ValidatorResult
    {
        $model = EmailPending::where([
            'email' => $email,
            'callback' => json_encode($callback)
        ])->first();

        $alreadyExist = true;

        if (!$model || $model->callback[0] != $callback[0]) {
            $model = new EmailPending();
            $model->email = $email;
            $model->callback = $callback;
            $model->payload = $payload;
            $model->save();
            $alreadyExist = false;
        }

        return new ValidatorResult($model->token, $alreadyExist, route('congregateemailvalidator.validate', ['token' => $model->token]));
    }

    public static function validate(string $token): bool
    {
        $model = EmailPending::where([
            'token' => $token
        ])->first();


        if ($model) {
            try {
                App::call($model->callback, ['payload' => array_merge($model->payload, ['email' => $model->email])]);;
                $model->delete();
                return true;
            } catch (\Exception $e) {
                Log::error(__("could not call callback"), [$e]);
            }
        }

        return false;
    }
}
