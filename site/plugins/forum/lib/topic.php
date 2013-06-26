<?php

namespace Kirby\Forum;

use Kirby\Toolkit\Model\Database;

// direct access protection
if(!defined('KIRBY')) die('Direct access is not allowed');

class Topic extends Database {

  // model setup 
  protected $table = 'topics';

  // cached properties
  protected $_user = null;

  public function posts() {
    return Posts::findByTopic($this);
  }

  public function thread() {
    return Forum::instance()->threads()->findByUID($this->read('thread'));
  }

  public function url() {
    return $this->thread()->url() . '/topic:' . $this->id();
  }

  public function user() {
    if(!is_null($this->_user)) return $this->_user;
    return $this->_user = Users::findById($this->read('user'));
  }

  public function added($format = null) {
    $ts = strtotime($this->read('added'));
    return (is_null($format)) ? $ts : date($format, $ts);
  }

}