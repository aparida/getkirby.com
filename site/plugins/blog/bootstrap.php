<?php

// direct access protection
if(!defined('KIRBY')) die('Direct access is not allowed');

// define the constants we are going to need throughout the plugin
define('KIRBY_BLOG_ROOT',          __DIR__);
define('KIRBY_BLOG_ROOT_LIB',      KIRBY_BLOG_ROOT . DS . 'lib');
define('KIRBY_BLOG_ROOT_SNIPPETS', KIRBY_BLOG_ROOT . DS . 'snippets');
define('KIRBY_BLOG_ROOT_TEMPLATES', KIRBY_BLOG_ROOT . DS . 'templates');

// custom files
define('KIRBY_SITE_ROOT_BLOG', KIRBY_SITE_ROOT . DS . 'blog');

// initialize the autoloader
$autoloader = new Kirby\Toolkit\Autoloader();

// set the base root where all classes are located
$autoloader->root = KIRBY_BLOG_ROOT_LIB;

// set the global namespace for all classes
$autoloader->namespace = 'Kirby\\Blog';

// add all needed aliases
$autoloader->aliases = array(
  'blog' => 'Kirby\\Blog\\Blog'
);

// start autoloading
$autoloader->start();