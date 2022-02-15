<?php

namespace App\Cms;

class Page
{
  protected array $attributes = [];

  public string $title = '';
  public string $subtitle = '';
  public string $intro = '';
  public string $content = '';
  public string $image = '';
  public array $images = [];
  public string $type = '';
  private ?Page $parent = null;

  public function __construct(array $attributes  = [])
  {
    foreach ($attributes as $name => $value) {
      $this->{$name} = $value;
    }
    $this->attributes = $attributes;
  }

  public function __get($name)
  {
    return $this->{$name} ?? $this->attributes[$name] ?? null;
  }

  public function __set($name, $value)
  {
    if (isset($this->{$name})) {
      $this->{$name} = $value;
    } else {
      $this->attributes[$name] = $value;
    }
  }
}
