<?php

namespace Modules\CongregateUi\View\Component\Base\Alert;

class Success extends Alert
{
    public function __construct(string $title = '', string $icon = '', array $list = [], string $type = self::TYPE_SUCCESS)
    {
        parent::__construct($title, $icon, $list, $type);
    }
}
