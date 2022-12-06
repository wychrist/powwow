<?php

namespace Modules\CongregateUi\View\Component\Base\Nav;

use Illuminate\View\Component;
use Modules\CongregateUi\Services\MenuService;
use Modules\CongregateUi\View\Traits\ColorTrait;
use Modules\CongregateUi\View\Traits\RenderTrait;

class Nav extends Component
{
    use RenderTrait;
    use ColorTrait;

    protected $view = 'congregateui::components.base.nav/nav';


    private function preMergeData(array $data)
    {

        $data['mainMenu'] = MenuService::getMenuById()->getChildren();

        return $data;
    }
}
