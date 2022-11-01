<?php

namespace Modules\CongregateUi\Services;


class MainMenuService
{

    private static $menus = [];

    public static function addToMenu(MenuItemService $item, $menuId = 'main')
    {
        if (!isset(self::$menus[$menuId])) {
            self::$menus[$menuId] = new MenuItemService($menuId, '#', $menuId);
        }

        self::$menus[$menuId]->addChildInstance($item);
    }


    public static function getMenuById($menuId = 'main'): MenuItemService {
        if (!isset(self::$menus[$menuId])) {
            self::$menus[$menuId] = new MenuItemService($menuId, '#', $menuId);
        }

        return self::$menus[$menuId];
    }

}
