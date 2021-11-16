<?php
if (!defined('WYCHRIST_INIT')) {
  exit;
}

use League\Plates\{Engine, Template\Theme};

if (!function_exists('app_root_dir')) {
  function app_root_dir(string $append = ''): string
  {
    $path = __DIR__;
    return $append ? $path . '/' . $append : $path;
  }
}

if (!function_exists('public_dir')) {
  function public_dir(string $append = ''): string
  {
    $path = dirname(__DIR__);
    return $append ? $path . '/' . $append : $path;
  }
}

if (!function_exists('content_dir')) {
  function content_dir(string $append = ''): string
  {
    $contentDir = $append ? 'content/' . $append : 'content';
    return app_root_dir($contentDir);
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
  function walk_settings($array, $pieces, $default)
  {
    $name = (is_array($pieces) && count($pieces) > 0) ? $pieces[0] : null;
    $value =  $default;
    if (is_array($array) && array_key_exists($name, $array)) {
      unset($pieces[0]);
      $value = $array[$name];
      if (count($pieces) > 0) {
        $value = walk_settings($value, array_values($pieces), $default);
      }
    }

    return $value;
  }
  function settings(string $name = '', $default = null)
  {
    static $settings;
    if (!$settings) {
      $settings = require_once __DIR__ . '/settings.php';
    }

    if ($name) {
      $pieces = explode('.', $name);
      return walk_settings($settings, $pieces, $default);
    } else {
      return $settings;
    }
  }
}

if (!function_exists('theme_dir')) {
  function theme_dir(string $append = ''): string
  {
    $themeDir = $append ? 'theme/' . $append : 'theme';
    return app_root_dir($themeDir);
  }
}

if (!function_exists('handle_route')) {
  function handle_route(string $uri)
  {
    $uri = trim(str_replace(['//', '.html', 'htm'], '', $uri));
    $routes = require_once content_dir('routes.php');
    if (isset($routes[$uri])) {
      include_once $routes[$uri];
    } else {
      echo '404 page not found';
    }
  }
}

if (!function_exists('theme_engine')) {
  function theme_engine(string $template = '')
  {
    static $themeEngine;
    if (!$themeEngine) {

      // $themeEngine = new League\Plates\Engine(theme_dir(settings('theme')));

      $theme = settings('theme');
      $themeEngine= Engine::fromTheme(Theme::hierarchy([
            Theme::new(theme_dir('base'), 'default_base'), // parent
            Theme::new(theme_dir($theme), $theme), // child
      ]));

      // register extensions
      $themeEngine->loadExtension(new League\Plates\Extension\Asset(public_dir()));
      $themeEngine->registerFunction('settings', 'settings');
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
