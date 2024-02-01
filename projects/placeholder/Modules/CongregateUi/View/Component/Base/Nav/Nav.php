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

    public function __construct(public string $menu = MenuService::MAIN_MENU)
    {
        MenuService::markCurrentRouteActive();
    }


    private function preMergeData(array $data)
    {

        $data['theMenu'] = MenuService::getMenuById($this->menu)->getChildren();

        return $data;
    }
}
