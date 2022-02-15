<?php

namespace App\Entity;

use App\Cms\Page;

class MenuItem extends Page {
     private array $items = [];


    public function __construct(array $attributes  = [])
    {
        parent::__construct($attributes);
        $this->id = uniqid('menuitem');
    }

     public function addChild(MenuItem $child): MenuItem
     {
         $this->items[$child->id] = $child;
         return $this;
     }

     public function children(): array
     {
         return $this->items;
     }

     public function toArray(): array
     {
         return [
             ...$this->attributes,
             'children' => collect($this->items)->map(function($i){
                 return $i->toArray();
             })->toArray()
         ];
     }
}
