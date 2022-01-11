<?php

use League\Plates\{Engine, Template\Theme};


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

if (!function_exists('settings')) {
    function settings(string $name = '', $default = null)
    {
        return config($name, $default);
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
        return app_root_dir('resources/views/theme/' . $append);
    }
}


if (!function_exists('theme_engine')) {
    function theme_engine(string $template = '')
    {
        static $themeEngine;
        if (!$themeEngine) {

            $theme = settings('app.theme');
            $themeEngine = Engine::fromTheme(Theme::hierarchy([
                Theme::new(theme_dir('base'), 'default_base'), // parent
                Theme::new(theme_dir($theme), $theme), // child
            ]));

            // register extensions
            $themeEngine->loadExtension(new League\Plates\Extension\Asset(public_dir()));
            $themeEngine->registerFunction('settings', 'settings');
            $themeEngine->registerFunction('get_data', 'get_data');
        }

        return $template ? $themeEngine->make($template) : $themeEngine;
    }
}

if (!function_exists('render_template')) {
    function render_template(string $template, array $data = [])
    {
        return theme_engine($template)->render($data);
    }
}
if (!function_exists('serve_template')) {
    function serve_template(string $template, array $data = [])
    {
        echo theme_engine($template)->render($data);
    }
}
