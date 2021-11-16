<?php
if(!defined('WYCHRIST_INIT')){
  exit;
}

if(!function_exists('app_root_dir')) {
  function app_root_dir(string $append = ''): string {
    $path = __DIR__ ;
    return $append ? $path . '/'. $append: $path;
  }
}

if (!function_exists('content_dir')) {
  function content_dir(string $append = ''): string {
    $contentDir = $append ? 'content/' . $append: 'content';
    return app_root_dir($contentDir);
  }
}
if (!function_exists('page_dir')) {
  function page_dir(string $append = ''): string {
    $pageDir = $append ? 'pages/' . $append: 'pages`';
    return content_dir($pageDir);
  }
}

if (!function_exists('theme_dir')) {
  function theme_dir(string $append = ''): string {
    $themeDir = $append ? 'theme/' . $append: 'theme';
    return app_root_dir($themeDir);
  }
}

if (!function_exists('handle_route')) {
  function handle_route(string $uri) {
    $uri = trim(str_replace(['//', '.html', 'htm'], '', $uri));
    $routes = require_once content_dir('routes.php');
    if(isset($routes[$uri])) {
      include_once $routes[$uri];
    } else {
      echo '404 page not found';
    }
  }
}