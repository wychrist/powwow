<?php

namespace App\Component\Layout\Component;
use Illuminate\View\Component;

class RightMenu extends Component {

    public function render()
    {
        return function(array $data = []) {
            return view('theme::layout.component.right_menu', $data)->render();
        };
    }
}
