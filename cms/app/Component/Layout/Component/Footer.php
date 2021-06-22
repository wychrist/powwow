<?php

namespace App\Component\Layout\Component;
use Illuminate\View\Component;

class Footer extends Component {

    public function render()
    {
        return function(array $data = []) {
            return view('theme::layout.component.footer', $data)->render();
        };
    }
}
