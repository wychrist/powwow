<?php

namespace App\Component\Layout;

use Illuminate\View\Component;

class ThreeColumns extends Component
{
    public function render()
    {
        return function (array $data = []) {
            return view('theme::layout.three_columns', $data)->render();
        };
    }
}
