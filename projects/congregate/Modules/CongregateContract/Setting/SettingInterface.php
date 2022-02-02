<?php

namespace Modules\CongregateContract\Setting;

interface SettingInterface {

    /**
     * Get a setting by name
     *
     */
    public function get(string $name, mixed $default = null): mixed;

    /**
     * Set or update an entry
     *
     */
    public function set(string|array $key, mixed $value = null): SettingInterface;

}
