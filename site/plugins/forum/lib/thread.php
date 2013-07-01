<?php

namespace Kirby\Forum;

use Kirby\CMS\Page;

// direct access protection
if(!defined('KIRBY')) die('Direct access is not allowed');

class Thread extends Page {

  public function topics() {
    return Topics::findByThread($this);
  }

  public function url($lang = null) {    
    return Forum::instance()->url() . '/' . $this->uid();
  }

}