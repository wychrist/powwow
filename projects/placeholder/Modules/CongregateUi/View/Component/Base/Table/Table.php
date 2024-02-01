<?php

namespace Modules\CongregateUi\View\Component\Base\Table;

use Illuminate\View\Component;
use Modules\CongregateTheme\Services\PageAsset;
use Modules\CongregateUi\View\Traits\ColorTrait;
use Modules\CongregateUi\View\Traits\RenderTrait;


class Table extends Component
{
  use RenderTrait;
  use ColorTrait;


  protected $view = 'congregateui::components.base.table/table';
}
