<?php

namespace App\Component\Layout\Component;
use Illuminate\View\Component;

class Header extends Component {

    public function render()
    {
        return function(array $data = []) {
            return view('theme::layout.component.header', $data)->render();
        };
    }
}
