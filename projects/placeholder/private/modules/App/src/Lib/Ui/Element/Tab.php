<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Lib\Ui\Element;

/**
 * Description of Tab
 *
 * @author unleash
 */
class Tab extends \Pama\Backend\UI\Card
{

    public static $style = <<< STYLE
<style>
/* copied from: https://www.w3schools.com/howto/tryit.asp?filename=tryhow_js_tabs */
/* Style the tab */

.tab-set{
 margin-bottom: 25px;
}

.tab {
  overflow: hidden;
  border: 1px solid #ccc;
  background-color: #f1f1f1;
}

/* Style the buttons inside the tab */
.tab button {
  background-color: inherit;
  float: left;
  border: none;
  outline: none;
  cursor: pointer;
  padding-top: 0.75rem;
  padding-right: 1.25rem;
  padding-bottom: 0.75rem;
  padding-left: 1.25rem;
  transition: 0.3s;
  font-size: 14px;
}

/* Change background color of buttons on hover */
.tab button:hover {
  background-color: #ddd;
}

/* Create an active/current tablink class */
.tab button.active {
  background-color: #ccc;
}

/* Style the tab content */
.tabcontent {
  display: none;
  padding: 6px 12px;
  border: 1px solid #ccc;
  border-top: none;
  background-color: #fff;
}
</style>
STYLE;
    protected $tabBtnDiv;
    protected $tabContentDiv;
    protected static $handlerSet = false;
    protected $firstTab = true;
    protected $tabEffectClass;

    public function __construct($id = false)
    {
        parent::__construct($id);
        // $this->addClass('tab-set');
        // tab div

        $this->tabBtnDiv = $this->getBody()->add('div', $this->get('id') . '_tab_div');
        $this->tabBtnDiv->addClass('tab');

        // content
        $this->tabContentDiv = $this->getBody()->add('div', $this->get('id') . '_tab_body_div');

        if (!self::$handlerSet) {
            self::setRenderHandler();
            self::$handlerSet = true;
        }

        $effectId = uniqid('tab_ef_');
        $this->tabEffectClass = $effectId;


        addListener('pama_theme.on_filter_header_js', function() use($effectId) {
            echo <<< SCRIPT
<script>
function {$effectId}_openTab(evt, eleId) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("{$effectId}");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("{$effectId}_tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(eleId).style.display = "block";
  evt.currentTarget.className += " active";
}
</script>
SCRIPT;
        });
    }

    public function addTab($label, $content = '', $id = '')
    {

        $tab = $this->tabBtnDiv->add('button');
        $tab->addClass($this->tabEffectClass . '_tablinks');
        if ($id) {
            $tab->set('id', $id);
        }
        $id = $tab->get('id');

        $tab->set('onclick', $this->tabEffectClass . "_openTab(event,'{$id}-content');return false;");

        $tab->setContent($label);

        $body = $this->tabContentDiv->add('div', "{$id}-content");

        $body->addClass($this->tabEffectClass);
        $body->addClass('tabcontent');
        $body->setContent($content);

        $body->setContent($content);

        if ($this->firstTab) {
            $this->firstTab = false;
            $tab->addClass('active');
            $body->set('style', 'display:block');
        }

        return $this;
    }

    protected static function setRenderHandler()
    {

        addListener('pama_theme.header_embed_css', function() {
            echo Tab::$style;
        });
    }

}
