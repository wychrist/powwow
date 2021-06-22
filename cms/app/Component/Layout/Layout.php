<?php

namespace App\Component\Layout;
use Illuminate\View\Component;

class Layout extends Component
{
    public function render()
    {
        return function (array $data = []) {
            return view('theme::layout.' . config('theme.layout', 'layout'), $data)->render();
        };
    }
}
