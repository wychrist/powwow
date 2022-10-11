<?php

return [
    /**
     * This should be your default theme directory
     */
    'themes_directory' => env('THEMES_DIRECTORY', resource_path("views/themes")),

    /**
     * The current active theme
     */
    'theme' => env('DEFAULT_THEME', 'base'),

    /**
     * The current active theme directory
     *
     * Change this value if the theme is not in the 'themes_directory'
     */
    'active_theme_directory' => env('ACTIVE_THEME_DIRECTORY',resource_path("views/themes")),

    /**
     * The current backend theme
     */
    'backend_theme' => env('DEFAULT_BACKEND_THEME', 'backend_base'),

    /**
     * The current active backend theme directory
     *
     * Change this value if the theme is not in the 'themes_directory'
     */
    'active_backend_theme_directory' => env('ACTIVE_BACKEND_THEME_DIRECTORY', env('ACTIVE_THEME_DIRECTORY',resource_path("views/themes"))),

];
