<?php

use App\Cms\Page;
use Modules\CongregateCms\Repositories\ContentRepository;

if (!function_exists('cms_page_url')) {
    function cms_page_url(string|int $slugOrId, bool $absolute = true)
    {
        return route('congregatecms.a_page', [
            'id' => $slugOrId
        ], $absolute);
    }
}

if (!function_exists('cms_post_url')) {
    function cms_post_url(string|int $slugOrId, bool $absolute = true)
    {
        return route('congregatecms.a_posts', [
            'id' => $slugOrId
        ], $absolute);
    }
}

if (!function_exists("cms_next_post")) {
    function cms_next_post(string $slug): Page | null
    {
        $repo = new ContentRepository();
        return $repo->getNextPost($slug);
    }
}

if (!function_exists("cms_previous_post")) {
    function cms_previous_post(string $slug): Page | null
    {
        $repo = new ContentRepository();
        return $repo->getPreviousPost($slug);
    }
}
