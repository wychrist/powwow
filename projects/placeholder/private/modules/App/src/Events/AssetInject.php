<?php

namespace App\Events;

use Fluid\EventDispatcher\Event;

class AssetInject extends Event
{

    const NAME = 'app.on_assets_inject';

    private $assets = [];
    private $ids = [];

    public function __construct(array $assets = [])
    {
        $this->assets = $assets;
    }

    public function addHeaderJsLink($link, $id = false)
    {
        $id = ($id) ? $id : uniqid();
        $this->assets[$id] = true;
        $this->assets['header']['js'][$id] = $link;
        return $this;
    }

    public function addHeaderCssLink($link, $id = false)
    {
        $id = ($id) ? $id : uniqid();
        $this->assets[$id] = true;
        $this->assets['header']['css'][$id] = $link;
        return $this;
    }

    public function addFooterJsLink($link, $id = false)
    {
        $id = ($id) ? $id : uniqid();
        $this->assets[$id] = true;
        $this->assets['footer']['js'][$id] = $link;
        return $this;
    }

    public function addHeaderJs($content, $id)
    {
        $id = ($id) ? $id : uniqid();
        $this->assets[$id] = true;
        $this->assets['header']['js_content'][$id] .= $content;
        return $this;
    }

    public function addHeaderCss($content, $id)
    {
        $id = ($id) ? $id : uniqid();
        $this->assets[$id] = true;
        $this->assets['header']['css_content'][$id] .= $content;
        return $this;
    }

    public function addFooterJs($content, $id)
    {
        $id = ($id) ? $id : uniqid();
        $this->assets[$id] = true;
        $this->assets['footer']['js_content'][$id] .= $content;
        return $this;
    }

    public function has($id)
    {
        return (isset($this->ids[$id]));
    }

    public function getHeaderJsLinks()
    {
        return $this->assets['header']['js'];
    }

    public function getHeaderCssLinks()
    {
        return $this->assets['header']['css'];
    }

    public function getFooterJsLinks()
    {
        return $this->assets['footer']['js'];
    }

    public function getHeaderJsContent()
    {
        return $this->assets['header']['js_content'];
    }

    public function getHeaderCssContent()
    {
        return $this->assets['header']['css_content'];
    }

    public function getFooterJsContent()
    {
        return $this->assets['footer']['js_content'];
    }

}
