<?php

namespace Modules\CongregateBackend\Http\Controllers;

use App\Models\OnlineContact;
use DebugBar\DebugBar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Log;
use Modules\CongregateBackend\Events\BackendTableFetchEvent;

class TableController extends BackendBaseController
{

  public function indexAction(Request $request, string $resource)
  {
    $eventName = BackendTableFetchEvent::makeName($resource);

    $cursor = $request->get('cursor');
    if ($cursor) {
      $cursor = json_decode(base64_decode($cursor), true);
    } else {
      $cursor = [
        'page' => 1,
        'limit' => 25,
        'last_id' => 0,
        'order_by' => [],
        'filters' => [],
        'fields' => [],
      ];
    }

    $event = new BackendTableFetchEvent($request, $cursor);
    Event::dispatch($eventName, $event);

    return $event->toArray();
  }

  public function exampleAction()
  {
    return view('congregatebackend::table_example');
  }
}
