<?php

if(!function_exists('cms_page_url')) {
    function cms_page_url(string|int $slugOrId) {
        return route('congregatecms.a_page', [
            'id' => $slugOrId
        ]);
    }
}

if(!function_exists('cms_post_url')) {
    function cms_post_url(string|int $slugOrId) {
        return route('congregatecms.a_posts', [
            'id' => $slugOrId
        ]);
    }
}
