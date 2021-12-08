<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Lib\Ui\Element;

/**
 * Description of Select
 *
 * @author unleash
 */
class Select extends \App\Lib\Ui\Html
{

    private $options;

    public function __construct($tag = false, $id = false)
    {
        parent::__construct('select', $id);
    }

    public function addOption(array $options)
    {
        foreach ($options as $key => $value) {
            $id = $this->get('id') . '_option_' . $key;
            $this->options[$id] = $this->add('option', $id)->set('value', $key)->setText($value);
        }

        return $this;
    }

    public function setActive($value = '')
    {
        $id = $this->get('id') . '_option_' . $value;
        if (isset($this->options[$id])) {
            $this->options[$id]->set('selected');
        }

        return $this;
    }

}
