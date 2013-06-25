<?php

// direct access protection
if(!defined('KIRBY')) die('Direct access is not allowed');

define('KIRBY_FORUM_ROOT',     __DIR__);
define('KIRBY_FORUM_ROOT_LIB', KIRBY_FORUM_ROOT . DS . 'lib');

require_once('helpers.php');

// initialize the autoloader
$autoloader = new Kirby\Toolkit\Autoloader();

// set the base root where all classes are located
$autoloader->root = KIRBY_FORUM_ROOT_LIB;

// set the global namespace for all classes
$autoloader->namespace = 'Kirby\\Forum';

// add all needed aliases
$autoloader->aliases = array();

// start autoloading
$autoloader->start();

// routes
router::register(array('GET'), 'support/forum/auth',   'support/forum');
router::register(array('GET'), 'support/forum/search', 'support/forum');