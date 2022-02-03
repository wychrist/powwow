<?php

namespace Modules\CongregateSetting;

use Illuminate\Support\Facades\Cache;
use Modules\CongregateSetting\Entities\Setting;

if (!function_exists('settings')) {
    function settings(string $name = '', $default = null): mixed
    {
        static $collection = null;
        if ($collection == null) {
            $collection = Cache::rememberForever('settings_cache', function () {
                $built = [];
                Setting::all()->each(function ($setting) use (&$built) {
                    if (!isset($built[$setting->module])) {
                        $built[$setting->module] = [];
                    }
                    $built[$setting->module][$setting->name] = $setting->value;
                });
                return $built;
            });
        }

        if (is_array($name)) {
            return set_settings($name);
        }

        return walk_settings($collection, explode('.', $name), config($name, $default));
    }
}


if (!function_exists('walk_settings')) {
    function walk_settings($array, $pieces, $default)
    {
        $name = (is_array($pieces) && count($pieces) > 0) ? $pieces[0] : null;
        $value =  $default;
        if (is_array($array) && array_key_exists($name, $array)) {
            unset($pieces[0]);
            $value = $array[$name];
            if (count($pieces) > 0) {
                $value = walk_settings($value, array_values($pieces), $default);
            }
        }

        return $value;
    }
}

if (!function_exists('set_settings')) {
    function set_settings($key, $value = null)
    {
        $keyValue = (is_array($key)) ? $key : [$key => $value];
        foreach ($keyValue as $name => $value) {
            $pieces = explode('.', $name);
            if (count($pieces) >= 2) {
                $setting = Setting::where([
                    'module' => $pieces[0],
                    'name' => $pieces[1]
                ])->firstOrNew([
                    'module' => $pieces[0],
                    'name' => $pieces[1]
                ]);

                if (is_array($value)) {
                    if (is_array($setting->value)) {
                        $setting->value = array_merge($setting->value, $value);
                    } else {
                        $setting->value = $value;
                    }
                } else {
                    $setting->value = $value;
                }

                $setting->save();
            }
        }

        Cache::flush('settings_cache');
    }
}
