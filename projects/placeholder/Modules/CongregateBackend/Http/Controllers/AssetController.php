<?php

namespace Modules\CongregateBackend\Http\Controllers;

use Illuminate\Http\Testing\MimeType;

class AssetController
{
  public function serveAction($path)
  {
    $path = dirname(dirname(__DIR__)) . '/Resources/assets/' . $path;


    if (file_exists($path)) {
      $type = MimeType::from($path);
      return response()->file($path, [
        'Content-type' => $type
      ]);
    }
    return response('', '404');
  }
}
