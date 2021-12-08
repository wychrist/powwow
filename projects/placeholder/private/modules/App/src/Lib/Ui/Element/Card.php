<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Lib\Ui\Element;

/**
 * Description of Card
 *
 * @author unleash
 */
class Card extends \App\Lib\Ui\Html
{

    private $Header;
    private $Body;
    private $Footer;
    private $toggleElement = null;
    private $openText;
    private $closeText;

    public function __construct($id = false)
    {
        parent::__construct('div', $id);

        $this->Header = $this->add('div', $this->get('id') . '_header');
        $this->Body = $this->add('div', $this->get('id') . '_body');
        $this->Footer = $this->add('div', $this->get('id') . '_footer');
    }

    public function setHeader($headerText)
    {
        $this->Header->setText($headerText);
        return $this;
    }

    public function showToggleButton($openText = 'Toggle', $closeText = 'Toggle', $tag = 'button')
    {

        $this->openText = $openText;
        $this->closeText = $closeText;

        $me = $this;
        if ($this->toggleElement == null) {
            $toggleElement = $this->Header->add($tag, $this->get('id') . '_toggle_btn');
        } else {
            $toggleElement = $this->toggleElement;
            $this->toggleElement->set('style', 'display:""');
        }

        $toggleElement->beforeRender(function($obj)use($me, $openText, $closeText) {
            $el = 'document.getElementById("' . $me->getBody()->id . '")';
            $self = 'document.getElementById("' . $obj->id . '")';
            $obj->set('onclick', "if({$el}.style.display =='none'){{$el}.style.display ='';{$self}.innerHTML='{$closeText}'}else{{$el}.style.display ='none';{$self}.innerHTML='{$openText}'};return false;");
        });
        $toggleElement->setContent(__($closeText));
        $toggleElement->set('style', 'float:right');
        $toggleElement->set('class', 'card-toggle-btn');
        $toggleElement->set('data-type', 'card-toggle-btn');
        $this->toggleElement = $toggleElement;

        return $this;
    }

    public function getToggleButton()
    {
        if (!$this->toggleElement) {
            $this->showToggleButton();
            $this->removeToggleButton();
        }

        return $this->toggleElement;
    }

    public function removeToggleButton()
    {
        if ($this->toggleElement) {
            $this->toggleElement->set('style', 'display:none');
        }

        return $this;
    }

    public function hasToggleButton()
    {
        return ($this->toggleElement != null) ? true : false;
    }

    public function close()
    {
        $this->Body->set('style', 'display:none');
        if ($this->toggleElement) {
            $this->toggleElement->setContent(__($this->openText));
        }

        return $this;
    }

    public function open()
    {
        $this->Body->set('style', 'display:""');
        if ($this->toggleElement) {
            $this->toggleElement->setContent(__($this->closeText));
        }

        return $this;
    }

    public function addBodyContent($content)
    {

        $this->Body->addContent($content);
        return $this;
    }

    public function getHeader()
    {
        return $this->Header;
    }

    public function getBody()
    {
        return $this->Body;
    }

    public function setFooterText($footerText)
    {
        $this->Footer->setText($footerText);
        return $this;
    }

    public function getFooter()
    {
        return $this->Footer;
    }

}
