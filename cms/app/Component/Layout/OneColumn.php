<?php

namespace App\Component\Layout;

use Illuminate\View\Component;

class OneColumn extends Component
{
    public function render()
    {
        return function (array $data = []) {
            return view('theme::layout.one_column', $data)->render();
        };
    }
}
