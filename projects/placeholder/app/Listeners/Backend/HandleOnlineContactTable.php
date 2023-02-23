<?php

namespace App\Listeners\Backend;

use App\Models\OnlineContact;
use Modules\CongregateBackend\Events\BackendTableFetchEvent;

class HandleOnlineContactTable
{


  public function __invoke(BackendTableFetchEvent $event)
  {
    $event->setResult(OnlineContact::all()->toArray());
  }
}
