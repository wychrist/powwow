<?php

use Illuminate\Support\Facades\Event;
use Modules\CongregateUi\Events\MenuLevelTransition;

if (!function_exists('generate_menu_html')) {

  function generate_menu_html($entries, int $level): string
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
        $builtMenu .=    generate_menu_html($children, $level + 1);
        $builtMenu .=  '</ul>';
      }
      $builtMenu .=  '</li>';
    }

    return $builtMenu;
  }
}
