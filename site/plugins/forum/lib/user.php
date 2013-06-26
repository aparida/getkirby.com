<?php

namespace Kirby\Forum;

use Kirby\Toolkit\Model\Database;

// direct access protection
if(!defined('KIRBY')) die('Direct access is not allowed');

class User extends Database {

  // model setup
  protected $table = 'users';

  public function url() {
    return 'http://twitter.com/' . $this->username();
  }
  
  public function avatar() {
    return 'http://twitter.com/api/users/profile_image/' . $this->username();  
  }
  
  public function admin() {
    return (in_array($this->username(), c::get('forum.admins', array()))) ? true : false;
  }

}