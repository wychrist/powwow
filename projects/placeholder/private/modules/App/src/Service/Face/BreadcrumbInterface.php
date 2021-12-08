<?php

namespace App\Service\Face;

/**
 *
 * @author unleash
 */
interface BreadcrumbInterface
{

    public function addItem($route, $label, $id = false);

    public function setActiveItem($id);

    public function toArray();

    public function toHtml();

    public function reset();
}
