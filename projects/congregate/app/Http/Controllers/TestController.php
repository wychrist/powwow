<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class TestController extends Controller
{

    public function indexAction()
    {
        $user = User::whereId(2)->first();
        $user->withAccessToken($user->tokens->first());

       if($user->tokenCan('*')) {
           return 'yes, you got the * token';
       } else {
           return 'you don\'t';
       }

       $token = $user->tokens->toArray();

       return [
           'token' => $token
       ];
    }
}
