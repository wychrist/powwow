<?php

/**
 * Project composer's vendor directory
 */
if (! defined('FLUID_VENDOR_DIR')) {
    define('FLUID_VENDOR_DIR', dirname(__FILE__) . '/vendor');
}

/**
 * Private directory where local modules and configuration are kept
 */
if (! defined('FLUID_PRIVATE_DIR')) {
    define('FLUID_PRIVATE_DIR', __DIR__);
}

/**
 * Directory where caches and generated classses are store
 *
 * This directory should not be use for sensitive data storage
 */
if (! defined('FLUID_APP_VAR_DIR')) {
    define('FLUID_APP_VAR_DIR', FLUID_PRIVATE_DIR . '/var');
}

/**
 * Directory where uploaded files or content that are needed
 * to be store to file system should be kept
 */
if (! defined('FLUID_APP_OPT_DIR')) {
    define('FLUID_APP_OPT_DIR', FLUID_PRIVATE_DIR . '/opt');
}

if(!defined('FLUID_APP_LANG_DIR')){
    define('FLUID_APP_LANG_DIR', FLUID_PRIVATE_DIR. '/lang');
}
