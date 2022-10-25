<?php

namespace Modules\CongregateUi\View\Component\Base\Alert;

use Illuminate\View\Component;
use Modules\CongregateUi\View\Traits\RenderTrait;

class Alert extends Component
{
    use RenderTrait;

    const TYPE_PRIMARY = 'primary',
        TYPE_SECONDARY = 'secondary',
        TYPE_SUCCESS = 'success',
        TYPE_DANGER = 'danger',
        TYPE_WARING = 'warning',
        TYPE_INFO = 'info',
        TYPE_LIGHT = 'light',
        TYPE_DARK = 'dark';

    public string $title = '';
    public array $alertList = [];
    public string $type = self::TYPE_PRIMARY;

    public array $classes = [
        "alert" => true,
        "alert-dismissible" => true,
        "fade" => true,
        "show" => true,
    ];

    public string $icon = '';

    private array $iconMaps = [
        self::TYPE_SUCCESS  => 'icon fas fa-check',
        self::TYPE_DANGER => 'icon fas fa-ban',
        self::TYPE_INFO => 'icon fas fa-info',
        self::TYPE_WARING => 'icon fas fa-exclamation-triangle'
    ];

    protected $view = 'congregateui::components.base.alert/alert';

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(string $title = '', string $icon = '', array $list = [], string $type = self::TYPE_PRIMARY)
    {
        $this->title = $title;
        $this->type = $type;
        $this->alertList = $list;
        $this->icon = $icon;

        if(!$this->icon && isset($this->iconMaps[$this->type])) {
            $this->icon = $this->iconMaps[$this->type];
        }
    }

    private function preMergeData(array $data)
    {
        $data['classes']["alert-{$this->type}"] = true;
        return $data;
    }

}
