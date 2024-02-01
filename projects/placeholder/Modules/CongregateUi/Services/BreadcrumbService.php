<?php

namespace Modules\CongregateUi\Services;

class BreadcrumbService
{
    private static array $crumbs;

    public static function add(string $label, string $url = '#')
    {
        self::$crumbs = self::$crumbs ?? [];
        self::$crumbs[] = self::make($label, $url);
    }

    public static function make(string $label, string $url = '#'): array
    {
        return [
            'label' => $label,
            'active' => false,
            'link' => $url
        ];
    }

    public static function all(): array
    {
        self::$crumbs = self::$crumbs ?? [];

        // self::$crumbs = array_merge([[
        //     'label' => 'Home',
        //     'link' => '/',
        //     'active' => false
        // ]], self::$crumbs);

        self::$crumbs[count(self::$crumbs) - 1]['active'] = true;

        return self::$crumbs;
    }
}
