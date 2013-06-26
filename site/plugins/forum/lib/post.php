<?php

namespace Kirby\Forum;

use Kirby\Toolkit\Model\Database;

// direct access protection
if(!defined('KIRBY')) die('Direct access is not allowed');

class Post extends Database {

  // model setup 
  protected $table = 'posts';

  // cached properties
  protected $_topic = null;
  protected $_user  = null;

  public function topic() {
    if(!is_null($this->_topic)) return $this->_topic;
    return $this->_topic = Topics::findById($this->read('topic'));
  }

  public function url() {
    return $this->topic()->url() . '/#post' . $this->id();
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