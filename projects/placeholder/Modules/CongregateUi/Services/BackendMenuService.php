<?php

namespace Modules\CongregateUi\Services;

use Illuminate\Support\Facades\Event;
use Modules\CongregateBackend\Events\BackendMenuSetupEvent;
use Modules\CongregateUi\Events\BackendMenuSetupEvent as EventsBackendMenuSetupEvent;

class BackendMenuService
{

  public const BACKEND_MENU = 'backend_menu';
  private static $hasSetup = false;

  private static MenuItem $settings;
  private static MenuItem $modules;

  public static function addSettingInstance(MenuItem $item)
  {
    self::setup();
    self::$settings->addChildInstance($item);
  }

  public static function addSetting(string $label, string | array $link = '#', string | null $icon = null, string $id = null, bool $active = false)
  {
    self::setup();
    self::$settings->addChild($label, $link, $icon, $id, $active);
  }


  public static function addModuleInstance(MenuItem $item)
  {
    self::setup();
    self::$modules->addChildInstance($item);
  }

  public static function addModule(string $label, string | array $link = '#', string | null $icon = null, string $id = null, bool $active = false)
  {
    self::setup();
    self::$modules->addChild($label, $link, $icon, $id, $active);
  }

  public static function setup(callable $beforeCallback = null, callable $afterCallback = null)
  {
    $menu =  MenuService::getMenuById(self::BACKEND_MENU);

    if (!self::$hasSetup) {
      if ($beforeCallback) {
        $beforeCallback($menu);
      }

      self::$modules = $menu->addChild('Modules', icon: 'fa-solid fa-cubes');
      self::$settings = $menu->addChild('Settings', icon: 'fa-solid fa-screwdriver-wrench');

      if ($afterCallback) {
        $afterCallback($menu);
      }

      Event::dispatch(new EventsBackendMenuSetupEvent());
    }
  }
}
