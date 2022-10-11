<?php

namespace Modules\CongregateUi\View\Component\Base\Alert;

use Illuminate\View\Component;

class ValidationError extends Component
{
    public $type = Alert::TYPE_DANGER;

    public function render()
    {
        return function(array $data) {
            return view('congregateui::components.base.alert/validation-error', $data)->render();
        };
    }
}