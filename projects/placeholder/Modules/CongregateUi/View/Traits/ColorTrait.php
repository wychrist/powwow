<?php

namespace Modules\CongregateUi\View\Traits;

trait ColorTrait
{
  public string $textColor = '';
  public string $bgColor = '';
  public string $headerBgColor = '';
  public string $footerBgColor = '';


  protected function mergeDataColorTrait(array $data)
  {
    // text

    // background
    $data['classes']['bg-' . $this->attributes->get('bg-color', '')] = $this->attributes->get('bg-color', false);
    $this->attributes->offsetUnset('header-color');

    // header
    $data['classes']['header-bg-' . $this->attributes->get('header-bg-header', '')] = $this->attributes->get('header-bg-color', false);
    $this->attributes->offsetUnset('header-bg-color');

    // footer
    $data['classes']['footer-bg-' . $this->attributes->get('footer-bg-header', '')] = $this->attributes->get('footer-bg-color', false);
    $this->attributes->offsetUnset('footer-bg-color');

    return $data;
  }
}
