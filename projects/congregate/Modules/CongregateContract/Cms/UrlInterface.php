<?php

namespace Modules\CongregateContract\Cms;

interface UrlInterface
{

    /**
     * Generates the full URL to the specified post
     */
    public static function post(string|int $slugOrId): string;

    /**
     * Generates the full URL to the specified page
     */
    public static function page(string|int $slugOrId): string;
}
