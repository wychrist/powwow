<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Service\Face;

use App\Lib\Ui\Html;

/**
 *
 * @author unleash
 */
interface UiServiceInterface
{

    /**
     * Returns the html element / component
     * 
     * @param string | boolean $tagOrComponent
     * @param string | boolean $id
     * 
     * @return Html
     */
    public function newUi($tagOrComponent = false, $id = false);
}
