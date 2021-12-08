<?php

namespace App\Service;

/**
 * Description of Menu
 *
 * @author unleash
 */
class Menu implements Face\MenuInterface
{

    /**
     *
     * @var \App\Lib\Ui\Html
     */
    protected $Menu;

    protected $currentRoute = [];

    public function __construct(Face\UiServiceInterface $UiService, $id = false)
    {
        $this->Menu = $UiService->newUi('app_menu_element', $id);

        if ($this->Menu->getTag() == 'app_menu_element') {
            $this->Menu->setTag('ul', $id);
        }

        $this->currentRoute = getApplication()->getRouteMacher()->matchRequest(getRequest());
    }

    public function getUiObj()
    {
        return $this->Menu;
    }

    public function appendItem($route, $label, array $routeArg = [], $id = '', $icon = '', $before = false, $after = false)
    {
        $isActive = false;
        if (!filter_var($route, FILTER_VALIDATE_URL)) {
            if($route == $this->currentRoute['_route']){
                $isActive = true;
            }
            $route = getUrl($route, $routeArg);
        }

        //dump(getApplication()->getRouteMacher()->matchRequest(getRequest()));die;

        $id = ($id) ? $id : strtolower(str_replace(' ', '-', $label));
        $ele = $this->Menu->add('li', $id, $before, $after);

        if($isActive){
            $ele->addClass('active');
        }

        $link = $ele->add('a', $id . '-link')->set('href', $route);
        $iconEle = $link->add('span', $id . '-link-icon');
        $link->add('span', $id . '-label')->setText($label);

        if ($icon) {
            if (!filter_var($icon, FILTER_VALIDATE_URL)) {
                $iconEle->add('span', $id . '-link-icon-img')->setContent($icon);
            } else {
                $iconEle->add('img', $id . '-link-icon-img')->set('src', $icon);
            }
        }

        return $this;
    }

    public function appendSubMenu($route, $label, array $routeArg = [], $id = '', $icon = '', $before = false, $after = false)
    {
        if (!filter_var($route, FILTER_VALIDATE_URL)) {
            $route = getUrl($route, $routeArg);
        }
        $id = ($id) ? $id : strtolower(str_replace(' ', '-', $label));

        $ele = $this->Menu->add('li', $id, $before, $after);
        $link = $ele->add('a', $id . '-link')->set('href', $route);
        $iconEle = $link->add('span', $id . '-link-icon');
        $link->add('span', $id . '-label')->setText($label);
        $SubMenu = make(self::class);
        $SubMenu->getUiObj()->set('id', $id . '-submenu');

        $ele->addNode($SubMenu->getUiObj());

        if ($icon) {
            if (!filter_var($icon, FILTER_VALIDATE_URL)) {
                $iconEle->add('span', $id . '-link-icon-img')->setContent($icon);
            } else {
                $iconEle->add('img', $id . '-link-icon-img')->set('src', $icon);
            }
        }

        return $SubMenu;
    }

    public function buildFromArray(array $menuArray)
    {
        $this->Menu->fromArray($menuArray);
    }

    public function toArray()
    {
        return $this->Menu->toArray();
    }

    public function toHthml()
    {
        return $this->Menu->render();
    }

    public function __toString()
    {
        return $this->toHthml();
    }

}
