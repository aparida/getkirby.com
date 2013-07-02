<?php

namespace Kirby\Forum;

use Kirby\Toolkit\C;
use Kirby\Toolkit\Collection;

// direct access protection
if(!defined('KIRBY')) die('Direct access is not allowed');

class Search {

  protected $query  = null;
  protected $topics = null;
  protected $posts  = null;

  public function __construct($query = null) {
    $this->query = $query;
  }

  public function topics() {

    if(!is_null($this->topics)) return $this->topics;

    if(!$this->query) return $this->topics = new Collection();

    $search = new \Kirby\Toolkit\Search($this->query, array('title', 'text'));

    $topics = new Topics();
    $topics->where($search->sql());

    return $this->topics = $topics->limit(25)->all();

  }

  public function posts() {

    if(!is_null($this->posts)) return $this->posts;

    if(!$this->query) return $this->posts = new Collection();

    $search = new \Kirby\Toolkit\Search($this->query, array('text'));
    
    $posts = new Posts();
    $posts->where($search->sql());

    return $this->posts = $posts->limit(25)->all();
  
  }

}