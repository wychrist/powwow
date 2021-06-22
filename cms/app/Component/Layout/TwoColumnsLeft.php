<?php

namespace App\Component\Layout;

use Illuminate\View\Component;

class TwoColumnsLeft extends Component
{
    public function render()
    {
        return function (array $data = []) {
            return view('theme::layout.two_columns_left', $data)->render();
        };
    }
}
