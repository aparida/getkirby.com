<?php

namespace Kirby\Forum;

use Kirby\Toolkit\DB\Query;

// direct access protection
if(!defined('KIRBY')) die('Direct access is not allowed');

class Posts extends Query {

  protected $fetch = 'Kirby\\Forum\\Post';
  protected $table = 'posts';

  static public function findByTopic($topic) {
    $posts = new static();
    return $posts->where(array('topic' => $topic->id()));
  }

}