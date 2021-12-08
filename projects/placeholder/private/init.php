<?php

try {
    // get composer instance
    $autoload_functions = spl_autoload_functions();
    $loader = $autoload_functions[0][0];
    (new \Fluid\Setup())->setComposer($loader)->boot();
} catch (Exception $ex) {
    // @todo fully implement this
    dd($ex);
    echo $ex->getMessage();
    die();
}