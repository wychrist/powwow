<?php

namespace Modules\Ui\View\Component\Base\Breadcrumb;

use Illuminate\View\Component;
use Modules\CongregateUi\Services\BreadcrumbService;
use Modules\CongregateUi\View\Traits\ColorTrait;
use Modules\CongregateUi\View\Traits\RenderTrait;

class Breadcrumb  extends Component
{

    use RenderTrait,
        ColorTrait;

    private $view = 'ui::components.base.breadcrumb/breadcrumb';

    public array $crumbs = [];

    public function __construct(array $crumbs = [])
    {
        foreach ($crumbs as $aCrump) {
            BreadcrumbService::add(...$aCrump);
        }

        $this->crumbs = BreadcrumbService::all();
    }

}