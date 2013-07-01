<?php 

function githublink() {

  $uri    = site()->uri();
  $repo   = $uri->path()->first();
  $type   = $uri->path()->nth(1);
  $url    = 'https://github.com/getkirby/' . $repo . '/blob/master';

  switch($type) {
    case 'classes':
      $class = $uri->path()->nth(2);
      $url  .= '/lib/' . $class;

      if($uri->path()->nth(3) == 'subclasses') {

        $sub1 = $uri->path()->nth(4);     
        $url .= '/' . $sub1;

        if($uri->path()->nth(5) == 'subclasses') {
          $sub2 = $uri->path()->nth(6);          
          $url .= '/' . $sub2;
        } 

      } 

      $url .= '.php'; 

      break;
    case 'helpers':
      $url .= '/helpers.php'; 
      break;
    case 'defaults':
      $url .= '/defaults.php';
      break;
    case 'constants':
      $url .= '/bootstrap.php';
      break;
    default:
      return false;
      break;
  }

  return $url;

}

function methodhead() {
  $page  = site()->pages()->active();
  $class = $page->parent()->parent();

  return ($class->template() != 'class') ? $page->name() : html::a($class->url(), str::lower($class->class())) . '::' . $page->name();

}