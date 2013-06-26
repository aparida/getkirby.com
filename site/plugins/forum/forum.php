<?php

// direct access protection
if(!defined('KIRBY')) die('Direct access is not allowed');

// we need a session for the forum
s::start();

define('KIRBY_FORUM_ROOT',         __DIR__);
define('KIRBY_FORUM_ROOT_LIB',     KIRBY_FORUM_ROOT . DS . 'lib');
define('KIRBY_FORUM_ROOT_VENDORS', KIRBY_FORUM_ROOT . DS . 'vendors');

// custom files
define('KIRBY_PROJECT_ROOT_FORUM', KIRBY_PROJECT_ROOT . DS . 'forum');

// load defaults
require_once(KIRBY_FORUM_ROOT . DS . 'defaults.php');

// load config
require_once(KIRBY_PROJECT_ROOT . DS . 'forum' . DS . 'config' . DS . 'config.php');

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

// routes
router::register(array('GET'),         c::get('forum.uri') . '/login',        'support/forum');
router::register(array('GET'),         c::get('forum.uri') . '/logout',       'support/forum');
router::register(array('GET', 'POST'), c::get('forum.uri') . '/search',       'support/forum');
router::register(array('GET', 'POST'), c::get('forum.uri') . '/(:any)/topic', 'support/forum');
