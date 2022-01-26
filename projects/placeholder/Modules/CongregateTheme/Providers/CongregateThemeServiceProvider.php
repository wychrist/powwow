<?php

namespace Modules\CongregateTheme\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Factory;
use Illuminate\Support\Facades\Config;

class CongregateThemeServiceProvider extends ServiceProvider
{
    /**
     * @var string $moduleName
     */
    protected $moduleName = 'CongregateTheme';

    /**
     * @var string $moduleNameLower
     */
    protected $moduleNameLower = 'congregatetheme';

    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerTranslations();
        $this->registerConfig();
        $this->registerViews();
        $this->loadMigrationsFrom(module_path($this->moduleName, 'Database/Migrations'));
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        require_once dirname(__DIR__) .'/helpers.php';
        $this->app->register(RouteServiceProvider::class);
    }

    /**
     * Register config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $this->publishes([
            module_path($this->moduleName, 'Config/config.php') => config_path($this->moduleNameLower . '.php'),
        ], 'config');
        $this->mergeConfigFrom(
            module_path($this->moduleName, 'Config/config.php'), $this->moduleNameLower
        );
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $viewPath = resource_path('views/modules/' . $this->moduleNameLower);

        $sourcePath = module_path($this->moduleName, 'Resources/views');

        $this->publishes([
            $sourcePath => $viewPath
        ], ['views', $this->moduleNameLower . '-module-views']);

        $this->loadViewsFrom(array_merge($this->getPublishableViewPaths(), [$sourcePath]), $this->moduleNameLower);

        // theme setup
        $themeBasePath = module_path($this->moduleName, 'Resources/views/themes/base');
        $currentTheme = Config::get('congregatetheme.theme_directory') .'/'. Config::get('congregatetheme.theme');

        // the base theme
        $this->loadViewsFrom([
            $themeBasePath
        ],'base_theme');

        // the current active theme
        $this->loadViewsFrom([
            $currentTheme,
            $themeBasePath
        ],'theme');

        // the current active theme's layouts
        $this->loadViewsFrom([
            $currentTheme .'/layouts',
            $themeBasePath .'/layouts'
        ],'theme_layout');

        // the current active theme's templates
        $this->loadViewsFrom([
            $currentTheme .'/templates',
            $themeBasePath .'/templates'
        ],'theme_template');

        // the current active theme's sections
        $this->loadViewsFrom([
            $currentTheme .'/sections',
            $themeBasePath .'/sections'
        ],'theme_section');

        // the current active theme's fragments
        $this->loadViewsFrom([
            $currentTheme .'/fragments',
            $themeBasePath .'/fragments'
        ],'theme_fragments');

        // @todo register component aganist the base theme

    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = resource_path('lang/modules/' . $this->moduleNameLower);

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, $this->moduleNameLower);
        } else {
            $this->loadTranslationsFrom(module_path($this->moduleName, 'Resources/lang'), $this->moduleNameLower);
        }
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }

    private function getPublishableViewPaths(): array
    {
        $paths = [];
        foreach (\Config::get('view.paths') as $path) {
            if (is_dir($path . '/modules/' . $this->moduleNameLower)) {
                $paths[] = $path . '/modules/' . $this->moduleNameLower;
            }
        }
        return $paths;
    }
}
