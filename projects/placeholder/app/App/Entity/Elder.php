<?php
namespace App\Entity;

use App\Cms\Page;

class Elder  extends Page
{
  protected array $requiredFields  = [
    'name',
    'image',
    'bio',
    'office'
  ];

  public function __construct(array $attributes  = [])
  {
    parent::__construct($attributes);

    foreach ($this->requiredFields as $checkFor) {
      if (!$this->{$checkFor}) {
        throw new \Exception("{$checkFor} is a require field for an elder");
      }
    }
  }
}
