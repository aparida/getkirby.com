<?php

namespace Kirby\Blog;

use Kirby\Toolkit\Tpl;

// direct access protection
if(!defined('KIRBY')) die('Direct access is not allowed');

class Tag {

  protected $name = null;

  /**
   * Constructor
   * 
   * @param string $name The tag name
   */
  public function __construct($name) {
    $this->name = $name;    
  }

  /**
   * Returns the tag name
   * 
   * @return string
   */
  public function name() {
    return $this->name;
  }

  /**
   * Returns the absolute url for the tag
   * 
   * @return string
   */
  public function url() {
    return tpl::get('blog')->url() . '/tag:' . urlencode($this->name());
  }

  /**
   * Makes it possible to echo the entire object
   * 
   * @return string
   */
  public function __toString() {
    return $this->name();
  }

}