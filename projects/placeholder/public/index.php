<?php

/**
 * Project composer's vendor directory
 */
define('FLUID_VENDOR_DIR', dirname(__DIR__) . '/private/vendor');

$composerFile = FLUID_VENDOR_DIR . '/autoload.php';

if (file_exists($composerFile)) {
    require_once $composerFile;
} else {
    echo "You need to composer in order to pull in the require vendors";
    die();
}

app()->handle(false);
