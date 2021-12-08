<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Service;

/**
 * Description of AbstractUiService
 *
 * @author unleash
 */
abstract class AbstractUiService
{

    public function newUi($tagOrComponent = false, $id = false)
    {
        $BeforeEvent = new \App\Events\UIElementCreate($tagOrComponent);

        dispatch($BeforeEvent, $BeforeEvent::NAME);

        $node = $BeforeEvent->getObj();
        if (!$node) {
            try {
                $class = '\\App\\Lib\\Ui\\Element\\' . ucfirst($tagOrComponent);
                $node = make($class, ['tag' => $tagOrComponent, 'id' => $id]);
            } catch (\Exception $ex) {
                $node = new \App\Lib\Ui\Html($tagOrComponent, $id);
            }
        }

        $AfterEvent = new \App\Events\UIElementAfterCreate($node, $tagOrComponent);

        dispatch($AfterEvent, $AfterEvent::NAME);

        return $AfterEvent->getNode();
    }
}
