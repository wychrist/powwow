<?php

namespace App\Service;

/**
 * Description of Breadcrumb
 *
 * @author unleash
 */
class Breadcrumb implements Face\BreadcrumbInterface
{

    private $items = [];

    public function addItem($route, $label, $id = false)
    {
        $id = ($id) ? $id : strtolower(str_replace(' ', '-', $label));

        if (!filter_var($route, FILTER_VALIDATE_URL)) {
            $route = getUrl($route);
        }
        $this->items[$id] = [
            'label' => $label,
            'id' => $id,
            'active' => false,
            'url' => $route,
        ];

        return $this;
    }

    public function setActiveItem($id)
    {
        if (isset($this->items[$id])) {
            $this->items[$id]['active'] = true;
        }
        return $this;
    }

    public function reset()
    {
        $this->items = [];
        return $this;
    }

    public function toArray()
    {
        return $this->items;
    }

    public function toHtml()
    {
        $html = '<ul>';
        foreach ($this->items as $key => $item) {
            $html .= '<li id="' . $key . '">';
            $html .= '<a href="' . $item['url'] . '">';
            $html .= $item['label'];
            $html .= '</a>';
            $html .= '</li>';

            if ($item['active']) {
                break;
            }
        }

        $html .= '</ul>';

        return $html;
    }

}
