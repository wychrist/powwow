<?php

namespace App\Component\Layout;

use Illuminate\View\Component;

class TwoColumnsRight extends Component
{
    public function render()
    {
        return function (array $data = []) {
            return view('theme::layout.two_columns_right', $data)->render();
        };
    }
}
