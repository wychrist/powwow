<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Lib\Ui\Element;

/**
 * Description of Button
 *
 * @author unleash
 */
class Button extends \App\Lib\Ui\Html
{

    const TYPE_PRIMARY = 'primary',
            TYPE_SECONDARY = 'secondary',
            TYPE_SUCCESS = 'success',
            TYPE_WARNING = 'warning',
            TYPE_DANGER = 'danger',
            TYPE_INFO = 'info',
            TYPE_LIGHT = 'light',
            TYPE_DARK = 'dark';

    private $uiType;

    public function __construct($tag = 'button', $id = false)
    {
        parent::__construct($tag, $id);
        $this->uiType = self::TYPE_PRIMARY;
    }

    public function setViewType($type)
    {
        $this->uiType = $type;
        return $this;
    }

    public function getViewType()
    {
        return $this->uiType;
    }

}
