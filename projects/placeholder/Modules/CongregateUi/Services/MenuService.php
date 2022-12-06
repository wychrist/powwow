<?php

namespace Modules\CongregateUi\Services;


class MenuService
{

    public const MAIN_MENU = 'menu';

    private static $menus = [];
    private static $nameRoutes = [];

    public static function addToMenu(MenuItem $item, $menuId = self::MAIN_MENU)
    {
        if (!isset(self::$menus[$menuId])) {
            self::$menus[$menuId] = new MenuItem($menuId, '#', $menuId);
        }

        self::$menus[$menuId]->addChildInstance($item);
    }


    public static function getMainMenu(): MenuItem {
        return self::getMenuById();
    }

    public static function getMenuById($menuId = self::MAIN_MENU): MenuItem {
        if (!isset(self::$menus[$menuId])) {
            self::$menus[$menuId] = new MenuItem($menuId, '#', $menuId);
        }

        return self::$menus[$menuId];
    }

    public static function getMenus(): array {
        return self::$menus;
    }

    public static function watchRoute(string $name, MenuItem $menuItem) {
        self::$nameRoutes[$name] = $menuItem;
    }

    public static function markCurrentRouteActive() {
        if (!empty(self::$nameRoutes)) {
            $name = \Request::route()->getName();
            if(isset(self::$nameRoutes[$name])) {
                self::$nameRoutes[$name]->setActive(true);
            }
        }
    }

}
