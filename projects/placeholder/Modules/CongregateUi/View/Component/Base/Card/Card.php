<?php

namespace Modules\CongregateUi\View\Component\Base\Card;

use Illuminate\View\Component;
use Modules\CongregateTheme\Services\PageAsset;
use Modules\CongregateUi\View\Traits\ColorTrait;
use Modules\CongregateUi\View\Traits\RenderTrait;

class Card extends Component
{
    use RenderTrait;
    use ColorTrait;

    public $header;
    public $title;
    public $footer;

    public bool $collapsible = false;
    public bool $closable = false;

    protected $view = 'congregateui::components.base.card/card';

    public function __construct(string $header = '', string $title = '', string $footer = '')
    {
        $this->header = $header;
        $this->title = $title;
        $this->footer = $footer;
    }

    private function preMergeData(array $data)
    {
        $data['classes']['card'] = true;
        $data['classes']['card-' . $this->attributes->get('header-bg-color', '')] = $this->attributes->get('header-bg-color', '');

        $this->collapsible = $this->attributes->get('collapsible', $this->collapsible);
        $this->closable = $this->attributes->get('closable', $this->closable);

        // footer bg color
        $data['footerClasses'] = [
            'card-footer' => true,
            'bg-'. $this->attributes->get('footer-bg-color', '') =>$this->attributes->get('footer-bg-color', false)
        ];

        // remove
        $this->attributes->offsetUnset('footer-bg-color');

        return $data;
    }

    private function mergeData(array $data)
    {
        // nothing to do here
        return $data;
    }
}
