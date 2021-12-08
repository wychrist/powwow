<?php
namespace App\Lib\Ui\Element;

/**
 * Description of Input
 *
 * @author unleash
 */
class Input extends \App\Lib\Ui\Html
{

    public function __construct($tag = false, $id = false)
    {
        parent::__construct('input', $id);
    }
}
