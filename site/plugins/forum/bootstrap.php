<?php

// direct access protection
if(!defined('KIRBY')) die('Direct access is not allowed');

// define the constants we are going to need throughout the plugin
define('KIRBY_FORUM_ROOT',         __DIR__);
define('KIRBY_FORUM_ROOT_LIB',     KIRBY_FORUM_ROOT . DS . 'lib');
define('KIRBY_FORUM_ROOT_VENDORS', KIRBY_FORUM_ROOT . DS . 'vendors');

// custom files
define('KIRBY_SITE_ROOT_FORUM', KIRBY_SITE_ROOT . DS . 'forum');

// we need a session for the forum
s::start();

// load helpers
require_once(KIRBY_FORUM_ROOT . DS . 'helpers.php');

// initialize the autoloader
$autoloader = new Kirby\Toolkit\Autoloader();

// set the base root where all classes are located
$autoloader->root = KIRBY_FORUM_ROOT_LIB;

// set the global namespace for all classes
$autoloader->namespace = 'Kirby\\Forum';

// add all needed aliases
$autoloader->aliases = array(
  'forum' => 'Kirby\\Forum\\Forum'
);

// start autoloading
$autoloader->start();

// load the kirby form handler
require_once(KIRBY_FORUM_ROOT_VENDORS . DS . 'form' . DS . 'bootstrap.php');