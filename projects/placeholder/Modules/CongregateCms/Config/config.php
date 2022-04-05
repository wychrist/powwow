<?php
return [
    'name' => 'CongregateCms',

    /*---------------------------------------------------------
                 POST CONFIGURATIONS
    ----------------------------------------------------------*/
    /**
     * --------------------------------------------------------
     * Controls if the posts endpoint should be registered
     * --------------------------------------------------------
     *
     */
    'register_posts_endpoint' => env('CON_CMS_REGISTER_POSTS_ENDPOINT', true),

    /**
     * ------------------------------------------------------
     * Posts endpoint. This maybe your 'blog' page
     * ------------------------------------------------------
     *
     */
    'posts_endpoint' => env('CON_CMS_POST_ENDPOINT', 'posts'),

    /**
     * ------------------------------------------------------
     * The default template to use for pages
     * ------------------------------------------------------
     *
     */
    'post_default_template' => env('CON_CMS_POST_DEFAULT_TEMPLATE', 'congregatecms::templates/post_default'),

    /*---------------------------------------------------------
                 PAGE CONFIGURATIONS
    ----------------------------------------------------------*/

    /**
     * --------------------------------------------------------
     * Controls if the pages endpoint should be registered
     * --------------------------------------------------------
     *
     */
    'register_pages_endpoint' => env('CON_CMS_REGISTER_PAGES_ENDPOINT', true),

    /**
     * ------------------------------------------------------
     * Page endpoint. This maybe your 'blog' page
     * ------------------------------------------------------
     *
     */
    'pages_endpoint' => env('CON_CMS_PAGE_ENDPOINT', 'pages'),

    /**
     * ------------------------------------------------------
     * The default template to use for pages
     * ------------------------------------------------------
     *
     */
    'page_default_template' => env('CON_CMS_PAGE_DEFAULT_TEMPLATE', 'congregatecms::templates/page_default'),

];
