<?php

use Illuminate\Support\Facades\View;

if (!function_exists('app_root_dir')) {
    function app_root_dir(string $append = ''): string
    {
        return base_path($append);
    }
}

if (!function_exists('public_dir')) {
    function public_dir(string $append = ''): string
    {
        return public_path($append);
    }
}

if (!function_exists('content_dir')) {
    function content_dir(string $append = ''): string
    {
        return app_root_dir('content/' . $append);
    }
}


if (!function_exists('page_dir')) {
    function page_dir(string $append = ''): string
    {
        $pageDir = $append ? 'pages/' . $append : 'pages`';
        return content_dir($pageDir);
    }
}

if (!function_exists('get_data')) {
    function get_data(string $name = '')
    {
        if ($name) {
            $data = include content_dir('/data/' . $name . '.php');
        } else {
            $data = '';
        }
        return $data;
    }
}

if (!function_exists('theme_dir')) {
    function theme_dir(string $append = ''): string
    {
        return app_root_dir(config('congregatetheme.theme_directory') .'/'. $append);
    }
}

if (!function_exists('render_template')) {
    function render_template(string $template, array $data = [])
    {
        if(isset($data['content'])) {
            View::share('content', $data['content']);
        }
        return view("theme_template::{$template}", $data);
    }
}
if (!function_exists('serve_template')) {
    function serve_template(string $template, array $data = [])
    {
        echo render_template($template, $data);
    }
}
