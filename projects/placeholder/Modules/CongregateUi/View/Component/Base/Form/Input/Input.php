<?php

namespace Modules\CongregateUi\View\Component\Base\Form\Input;

use Illuminate\View\Component;
use Modules\CongregateUi\View\Traits\ColorTrait;
use Modules\CongregateUi\View\Traits\RenderTrait;

class Input extends Component
{
  use RenderTrait;
  use ColorTrait;

  public function __construct(private $type = 'text', private ?string $name = null)
  {
  }

  protected $view = 'congregateui::components.base.form.input/base';


  private function preMergeData(array $data)
  {
    $data['name'] = $this->name ?? uniqid('input_');
    $data['type'] = $this->type;
    return $data;
  }
}
