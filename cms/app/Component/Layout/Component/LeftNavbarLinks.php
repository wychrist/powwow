<?php

namespace App\Component\Layout\Component;
use Illuminate\View\Component;

class LeftNavbarLinks extends Component
{
    public function render()
    {
        return function (array $data = []) {
            return view('theme::layout.component.left_navbar_links', $data)->render();
        };
    }
}
