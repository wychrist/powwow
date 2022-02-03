<?php

namespace Modules\CongregateSetting;

use Modules\CongregateContract\Setting\SettingInterface;

class Setting implements SettingInterface
{
    public function get(string $name, mixed $default = null): mixed
    {
       return settings($name,$default);
    }

    public function set(string|array $key, mixed $value = null): SettingInterface
    {
        set_settings($key, $value);

        return $this;
    }
}
