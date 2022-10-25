<?php

namespace Modules\CongregateUi\View\Component\Base\Alert;

class Light extends Alert
{
    public function __construct(string $title = '', string $icon = '', array $list = [], string $type = self::TYPE_LIGHT)
    {
        parent::__construct($title, $icon, $list, $type);
    }
}
