<?php

namespace Modules\CongregateEmailValidator\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\CongregateEmailValidator\EmailValidator;

class ValidatorController extends Controller
{
    public function validateAction(string $token)
    {
        EmailValidator::validate($token);

        return view('congregateemailvalidator::validation_result');
    }
}
