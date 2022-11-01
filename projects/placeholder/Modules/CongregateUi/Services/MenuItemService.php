<?php

namespace Modules\CongregateUi\Services;


class MenuItemService
{

    private $children = [];
    private string $label;
    private string $link;
    private string $id;
    private bool $active;

    public function __construct(string $label, string $link, string $id = null, bool $active = false)
    {
        $this->label = $label;
        $this->link = $link;
        $this->id  = $id ?? md5($this->label . $this->link);
        $this->active = $active;
    }

    public function getLabel(): string
    {
        return $this->label;
    }

    public function getLink(): string
    {
        return $this->link;
    }

    public function isActive(): bool
    {
        return $this->active;
    }

    public function getId()
    {
        return $this->id;
    }

    public function addChildInstance(self $item): self
    {
        $this->children[$item->getId()] = $item;
        return $item;
    }
    public function addChild(string $label, string $link, string $id = null, bool $active = false)
    {
        $id = $id ?? md5($label . $link);
        $this->children[$id] = new self($label, $link, $id, $active);

       return  $this->children[$id];
    }

    public function addChildren(array $children)
    {
        foreach ($children as $child) {
            $this->children[$child->getId()] = $child;
        }
    }

    public function getChildById(string $id)
    {
        return $this->children[$id];
    }

    public function getChildren()
    {
        return $this->children;
    }
}
