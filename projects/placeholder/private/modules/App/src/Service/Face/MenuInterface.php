<?php

namespace App\Service\Face;

/**
 *
 * @author unleash
 */
interface MenuInterface
{

    public function buildFromArray(array $menuArray);

    /**
     *
     * @param string $route
     * @param string $label
     * @param array $routeArg argument to pass to the URL generator
     * @param string $id
     * @param string $icon full URL to icon
     * @param boolean $before
     * @param boolean $after
     *
     * @return MenuInterface
     */
    public function appendItem($route, $label, array $routeArg = [], $id = '', $icon = '', $before = false, $after = false);

    /**
     *
     * @param string $route
     * @param string $label
     * @param array $routeArg argument to pass to the URL generator
     * @param string $id
     * @param string $icon full URL to icon
     * @param boolean $before
     * @param boolean $after
     *
     * @return MenuInterface
     */
    public function appendSubMenu($route, $label, array $routeArg = [], $id = '', $icon = '', $before = false, $after = false);

    public function toArray();

    public function toHthml();

    /**
     * @return \App\Lib\Ui\Html
     */
    public function getUiObj();
}
