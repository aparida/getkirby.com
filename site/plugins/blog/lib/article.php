<?php

namespace Kirby\Blog;

use Kirby\Toolkit\C;
use Kirby\Toolkit\Collection;
use Kirby\Toolkit\Str;
use Kirby\CMS\Page;

// direct access protection
if(!defined('KIRBY')) die('Direct access is not allowed');

class Article extends Page {

  // cache for the tags collection
  protected $_tags = null;

  /**
   * Returns a collection with all tags for the this article
   * 
   * @return object
   */
  public function tags() {

    if(!is_null($this->_tags)) return $this->_tags;

    $raw  = str::split(parent::tags());
    $tags = new Collection();

    foreach($raw as $tag) {
      $tags->set($tag, new Tag($tag));
    }        

    return $this->_tags = $tags;

  }

}