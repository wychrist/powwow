<?php

namespace Modules\CongregateUi\Services;


class MenuService
{

    const MAIN_MENU = 'menu';

    private static $menus = [];

    public static function addToMenu(MenuItemService $item, $menuId = self::MAIN_MENU)
    {
        if (!isset(self::$menus[$menuId])) {
            self::$menus[$menuId] = new MenuItemService($menuId, '#', $menuId);
        }

        self::$menus[$menuId]->addChildInstance($item);
    }


    public static function getMainMenu(): MenuItemService
    {
        return self::getMenuById();
    }

    public static function getMenuById($menuId = self::MAIN_MENU): MenuItemService
    {
        if (!isset(self::$menus[$menuId])) {
            self::$menus[$menuId] = new MenuItemService($menuId, '#', $menuId);
        }

        return self::$menus[$menuId];
    }

    public static function getMenus(): array
    {
        return self::$menus;
    }
}
