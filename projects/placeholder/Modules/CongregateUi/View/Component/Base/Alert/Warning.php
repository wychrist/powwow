<?php

namespace Modules\CongregateUi\View\Component\Base\Alert;

class Warning extends Alert
{
    public function __construct(string $title = '', string $icon = '', array $list = [], string $type = self::TYPE_WARING)
    {
        parent::__construct($title, $icon, $list, $type);
    }
}
