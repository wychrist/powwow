<?php

namespace Modules\CongregateUi\View\Component\Base\Alert;

class Danger extends Alert
{
    public function __construct(string $title = '', string $icon = '', array $list = [], string $type = self::TYPE_DANGER)
    {
        parent::__construct($title, $icon, $list, $type);
    }
}
