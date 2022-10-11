<?php

namespace Modules\CongregateUi\View\Component\Base\Alert;

use Illuminate\View\Component;

class Alert extends Component
{
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

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(string $title = '', string $type = self::TYPE_PRIMARY, string $icon = '', array $list = [])
    {
        $this->title = $title;
        $this->type = $type;
        $this->alertList = $list;
        $this->classes["alert-{$this->type}"] = true;
        $this->icon = $icon;

        if(!$this->icon && isset($this->iconMaps[$this->type])) {
            $this->icon = $this->iconMaps[$this->type];
        }
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return function ($data) {
            return view('congregateui::components.base.alert/alert', $data)->render();
        };
    }
}