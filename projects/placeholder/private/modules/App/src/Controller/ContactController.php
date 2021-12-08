<?php

namespace App\Controller;

use Fluid\Base\Response;
use Fluid\Http\Controller as BaseController;

class ContactController extends BaseController
{
   public function indexAction(Response $response)
   {
      return $response->setContent('contact us');
   }

   public function handeFormAction()
   {
   }
}
