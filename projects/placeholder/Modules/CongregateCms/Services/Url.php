<?php

namespace Modules\CongregateCms\Services;

use Modules\CongregateContract\Cms\UrlInterface;

class Url implements  UrlInterface
{
    public static function post(string|int $slugOrId, bool $absolute = true): string
    {
        return cms_post_url($slugOrId, $absolute);
    }

    public static function page(string|int $slugOrId, bool $absolute = true): string
    {
        return cms_page_url($slugOrId, $absolute);
    }
}
