<?php

namespace App\Component\Layout;

use Illuminate\View\Component;

class TwoColumns extends Component
{
    public function render()
    {
        return function (array $data = []) {
            return view('theme::layout.two_columns', $data)->render();
        };
    }
}
