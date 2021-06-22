<?php

namespace App\Component\Layout\Component;
use Illuminate\View\Component;

class Navbar extends Component {

    public function render()
    {
        return function(array $data = []) {
            return view('theme::layout.component.navbar', $data)->render();
        };
    }
}
