<?php

namespace App\Providers;

use App\Component\Layout\Layout;
use App\Component\Layout\OneColumn;
use App\Component\Layout\ThreeColumns;
use App\Component\Layout\TwoColumns;
use App\Component\Layout\TwoColumnsLeft;
use App\Component\Layout\TwoColumnsRight;
use App\Component\Layout\Component\Breadcrumb;
use App\Component\Layout\Component\Footer;
use App\Component\Layout\Component\Header;
use App\Component\Layout\Component\LeftMenu;
use App\Component\Layout\Component\LeftNavbarLinks;
use App\Component\Layout\Component\Navbar;
use App\Component\Layout\Component\RightMenu;
use App\Component\Layout\Component\RightNavbarLinks;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use App\Component\Component\Card;

class ThemeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $currentTheme = config('theme.theme', 'base');

        $this->loadViewsFrom([
            resource_path("views/themes/{$currentTheme}")
        ], 'theme');

        // layouts
        Blade::component('theme-layout', Layout::class);
        Blade::component('theme-one-column', OneColumn::class);
        Blade::component('theme-three-columns', ThreeColumns::class);
        Blade::component('theme-two-columns-left', TwoColumnsLeft::class);
        Blade::component('theme-two-columns-right', TwoColumnsRight::class);
        Blade::component('theme-two-columns', TwoColumns::class);

        // components
        Blade::component('theme-layout-left-menu', LeftMenu::class);
        Blade::component('theme-layout-right-menu', RightMenu::class);
        Blade::component('theme-layout-header', Header::class);
        Blade::component('theme-layout-footer', Footer::class);
        Blade::component('theme-layout-breadcrumb', Breadcrumb::class);
        Blade::component('theme-layout-navbar', Navbar::class);
        Blade::component('theme-layout-left-navbar-links', LeftNavbarLinks::class);
        Blade::component('theme-layout-right-navbar-links', RightNavbarLinks::class);

        // collections
        Blade::component('theme-ui-card', Card::class);
    }
}
