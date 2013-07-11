<?php

namespace Kirby\Blog;

use Kirby\Toolkit\C;
use Kirby\Toolkit\Collection;
use Kirby\Toolkit\Object;
use Kirby\Toolkit\Str;
use Kirby\Toolkit\Tpl;
use Kirby\CMS\Page;

// direct access protection
if(!defined('KIRBY')) die('Direct access is not allowed');

class Blog extends Page {

  // cache for the articles collection
  protected $_articles = null;
  
  // cache for the tags collection
  protected $_tags = null;

  /**
   * Returns a collection with all articles
   * on the current page
   * 
   * @return object
   */
  public function articles() {

    if(!is_null($this->_articles)) return $this->_articles;

    // get the current tag
    $tag = urldecode(param('tag'));

    // get all visible articles
    $articles = $this->children()->visible();

    // filter the articles by tags
    if($tag) $articles = $articles->filterBy('tags', $tag, ',');

    // sort the articles and paginate them
    $articles = $articles->sortBy('date', 'desc')->paginate(c::get('blog.limit.articles'));

    // return and cache the collection of articles
    return $this->_articles = $articles;

  }

  /**
   * Returns a collection with all tags from all articles
   * 
   * @return object
   */
  public function tags() {

    if(!is_null($this->_tags)) return $this->_tags;
    
    $cloud = array();
    
    foreach($this->children()->visible() as $p) {
    
      $tags = str::split($p->tags());  
      
      foreach($tags as $t) {
              
        if(isset($cloud[$t])) {
          $cloud[$t]->results++;
        } else {
          $cloud[$t] = new Object(array(
            'results'  => 1,
            'name'     => $t,
            'url'      => $this->url() . '/tag:' . urlencode($t), 
            'isActive' => (param('tag') == $t) ? true : false,
          ));
        }
        
      }
      
    }
            
    return $this->_tags = new Collection($cloud);  

  }

  /**
   * Returns the absolute url for the blog's feed
   * 
   * @return string
   */
  public function feedurl() {
    return $this->url() . '/feed';
  }

  /**
   * Builds the article navigation
   * 
   * @return string
   */
  public function pagination() {

    // custom snippet file
    $file = KIRBY_SITE_ROOT_SNIPPETS . DS . 'blog.pagination.php';                
    
    // fallback to the default snippet file
    if(!file_exists($file)) {
      $file = KIRBY_BLOG_ROOT_SNIPPETS . DS . 'blog.pagination.php';
    }

    // load the snippet
    return tpl::loadFile($file, array(
      'pagination' => $this->articles()->pagination()
    ), true);

  }

}