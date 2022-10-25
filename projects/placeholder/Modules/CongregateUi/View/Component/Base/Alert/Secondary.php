<?php

namespace Modules\CongregateUi\View\Component\Base\Alert;

class Secondary extends Alert
{
    public function __construct(string $title = '', string $icon = '', array $list = [], string $type = self::TYPE_SECONDARY)
    {
        parent::__construct($title, $icon, $list, $type);
    }
}
