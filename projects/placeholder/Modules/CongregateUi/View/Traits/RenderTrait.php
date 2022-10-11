<?php

namespace Modules\CongregateUi\View\Traits;

trait RenderTrait
{

  public function render()
  {
    return function ($data) {
      if (!isset($data['classes'])) {
        $data['classes'] = [];
      }
      if (method_exists($this, 'preMergeData')) {
        $data = $this->preMergeData($data);
      }
      // call all other traits
      foreach (class_uses_recursive($class = static::class) as $trait) {
        if (method_exists($class, $method = 'mergeData' . class_basename($trait))) {
          $data = $this->{$method}($data);
        }
      }

      if (method_exists($this, 'mergeData')) {
        $data = $this->mergeData($data);
      }

      return view($this->view, $data)->render();
    };
  }
}
