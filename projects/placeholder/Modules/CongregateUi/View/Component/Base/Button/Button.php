<?php

namespace Modules\CongregateUi\View\Component\Base\Button;

use Illuminate\View\Component;
use Modules\CongregateUi\View\Traits\ColorTrait;
use Modules\CongregateUi\View\Traits\RenderTrait;

class Button extends Component
{

    use RenderTrait;
    use ColorTrait;

    protected $view = 'congregateui::components.base.button/button';

    public function __construct()
    {
    }

    private function preMergeData(array $data)
    {
        $data['classes']['btn'] = true;
        return $data;
    }
}
