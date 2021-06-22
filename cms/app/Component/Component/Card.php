<?php

namespace App\Component\Component;
use Illuminate\View\Component;

class Card extends Component {

    public function render()
    {
        return function(array $data = []) {
            return view('theme::component.card', $data)->render();
        };
    }
}
