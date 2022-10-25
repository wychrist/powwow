<?php

namespace Modules\CongregateUi\View\Component\Base\Alert;

class Info extends Alert
{
    public function __construct(string $title = '', string $icon = '', array $list = [], string $type = self::TYPE_INFO)
    {
        parent::__construct($title, $icon, $list, $type);
    }
}
