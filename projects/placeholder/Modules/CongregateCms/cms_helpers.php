<?php

if(!function_exists('cms_page_url')) {
    function cms_page_url(string|int $slugOrId) {
        return config()->get('congregatecms.pages_endpoint', 'posts') . "/{$slugOrId}";
    }
}

if(!function_exists('cms_post_url')) {
    function cms_post_url(string|int $slugOrId) {
        return config()->get('congregatecms.posts_endpoint', 'posts') . "/{$slugOrId}";
    }
}
