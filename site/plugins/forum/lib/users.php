<?php

namespace Kirby\Forum;

use Kirby\Toolkit\DB\Query;

// direct access protection
if(!defined('KIRBY')) die('Direct access is not allowed');

class Users extends Query {

  protected $fetch = 'Kirby\\Forum\\User';
  protected $table = 'users';

  static public function findByUsername($username) {
    $users = new static();
    return $users->where(array('username' => $username))->first();
  }

  static public function findById($id) {
    $users = new static();
    return $users->where(array('id' => $id))->first();
  }

  static public function findByTwitterId($tid) {
    $users = new static();
    return $users->where(array('tid' => $tid))->first();
  }

}