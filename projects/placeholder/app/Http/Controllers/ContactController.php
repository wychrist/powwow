<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{

    public function indexAction()
    {
        return 'Contact us page';
    }

    public function handleAction()
    {
        return 'handled';
    }
}
