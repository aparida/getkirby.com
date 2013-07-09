<?php

// direct access protection
if(!defined('KIRBY')) die('Direct access is not allowed');

// load defaults
f::load(__DIR__ . DS . 'defaults.php');

// load config
f::load(KIRBY_SITE_ROOT . DS . 'forum' . DS . 'config' . DS . 'config.php');

// the forum uri
$uri = c::get('forum.uri');

// routes
router::register(array('GET'),         $uri . '/login',        $uri);
router::register(array('GET'),         $uri . '/logout',       $uri);
router::register(array('GET', 'POST'), $uri . '/search',       $uri);
router::register(array('GET', 'POST'), $uri . '/(:any)/topic', $uri);

// load the bootstrapper only on forum pages
if(page()->template() == 'forum') {
  require_once(__DIR__ . DS . 'bootstrap.php');
}