<?php

namespace Kirby\Forum;

use Kirby\Toolkit\DB\Query;

// direct access protection
if(!defined('KIRBY')) die('Direct access is not allowed');

class Topics extends Query {

  protected $fetch = 'Kirby\\Forum\\Topic';
  protected $table = 'topics';

  static public function findByThread($thread) {
    $topics = new static();
    return $topics->where(array('thread' => $thread->uid()))->order('added desc');
  }

  static public function findById($id) {
    $topics = new static();
    return $topics->where(array('id' => $id))->first();
  }

  static public function latest() {
    $topics = new static();
    return $topics->order('added desc');
  }

}