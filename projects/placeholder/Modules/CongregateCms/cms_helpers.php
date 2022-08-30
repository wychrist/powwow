<?php

if(!function_exists('cms_page_url')) {
    function cms_page_url(string|int $slugOrId, bool $absolute = true) {
        return route('congregatecms.a_page', [
            'id' => $slugOrId
        ], $absolute);
    }
}

if(!function_exists('cms_post_url')) {
    function cms_post_url(string|int $slugOrId, bool $absolute = true) {
        return route('congregatecms.a_posts', [
            'id' => $slugOrId
        ], $absolute);
    }
}
