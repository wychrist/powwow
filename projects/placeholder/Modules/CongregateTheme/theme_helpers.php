<?php

use Illuminate\Support\Facades\Event;
use Modules\CongregateTheme\Events\Backend\MenuLevelTransition;

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
        return app_root_dir('storage/app/content/' . $append);
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
        return config('congregatetheme.themes_directory', '') . (($append) ? '/' . $append : '');
    }
}

if (!function_exists('inject_template_data')) {
    function inject_template_data($data)
    {
        if (isset($data['content'])) {
            // View::share('content', $data['content']);
        }

        if (!isset($data['setting'])) {
            // View::share('setting', app(SettingInterface::class));
        }

        return $data;
    }
}

if (!function_exists('render_template')) {
    function render_template(string $template, array $data = [])
    {
        $data = inject_template_data($data);
        return view("theme_template::{$template}", $data)->render();
    }
}


if (!function_exists('render_backend_template')) {
    function render_backend_template(string $template, array $data = [])
    {
        $data = inject_template_data($data);
        return view("backend_theme_template::{$template}", $data)->render();
    }
}

if (!function_exists('custom_template')) {
    function custom_template(string $template, array $data = [])
    {
        $data = inject_template_data($data);
        return view($template, $data)->render();
    }
}

if (!function_exists('serve_template')) {
    function serve_template(string $template, array $data = [])
    {
        echo render_template($template, $data);
    }
}
if (!function_exists('serve_backend_template')) {
    function serve_backend_template(string $template, array $data = [])
    {
        echo render_backend_template($template, $data);
    }
}

if (!function_exists('walk_backend_menu_item')) {

    function walk_backend_menu_item($entries, int $level): string
    {

        $builtMenu = "";

        $event  = new MenuLevelTransition($entries, $level);
        Event::dispatch($event);
        $builtMenu = $event->getHtml();
        if ($builtMenu) {
            return $builtMenu;
        }

        foreach ($entries as $item) {
            $children = $item->getChildren();
            $active = ($item->isActive() || ($level == 0 && $item->getHasActiveChild())) ? 'active' : '';
            $open = ($active) ? 'menu-open' : '';
            $link = $item->getLink();
            $icon = $item->getIcon() ?? 'unknown-icon';

            $builtMenu .= "<li class=\"nav-item {$open}\">
                        <a href=\"{$link}\" class=\"nav-link {$active}\">
                        <i class=\" {$icon} nav-icon\"></i>
                        <p>{$item->getLabel()}</p>
                        </a>";

            if ($children) {
                $builtMenu .=  '<ul class="nav nav-treeview">';
                $builtMenu .=    walk_backend_menu_item($children, $level + 1);
                $builtMenu .=  '</ul>';
            }
            $builtMenu .=  '</li>';
        }

        return $builtMenu;
    }
}
