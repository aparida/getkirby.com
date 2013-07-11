<?php

// direct access protection
if(!defined('KIRBY')) die('Direct access is not allowed');

// load defaults
f::load(__DIR__ . DS . 'defaults.php');

// load config
f::load(KIRBY_SITE_ROOT . DS . 'blog' . DS . 'config' . DS . 'config.php');

// the blog uri
$uri = c::get('blog.uri');

// routes
router::register(array('GET'), $uri . '/feed', $uri);
//router::register(array('GET'), $uri . '/archive', $uri);

// get the current page
$page     = site::instance()->activePage();
$template = $page->template();

use Kirby\Blog\Blog;
use Kirby\Blog\Article;

// make the blog available from $site->blog() as well
site::extend('blog', function($site) {

  static $blog;

  if(is_null($blog)) {

    // load the bootstrapper
    require_once(__DIR__ . DS . 'bootstrap.php');
    
    // create the blog class
    $blog = new Blog($site->children()->find(c::get('blog.uri')));

  }

  return $blog;

});

// load the bootstrapper only on forum pages
if($template == c::get('blog.template.index') or $template == c::get('blog.template.article')) {
  
  // get the blog object
  $blog = site::instance()->blog();

  // make the blog variable available in all templates and snippets
  tpl::set('blog', $blog);

  // make the article globally available if we are on a article page
  if($template == c::get('blog.template.article')) {    
    $article = new Article($page);
    tpl::set('article', $article);
  } else {

    switch(site()->uri()->path()->last()) {
      case 'archive':
        // not there yet
        break;
      case 'feed':

        $tpl = __DIR__ . DS . 'templates' . DS . 'blog.feed.php';

        die(tpl::loadFile($tpl, array(
          'blog' => $blog
        )));

        break;
    }

  }

}