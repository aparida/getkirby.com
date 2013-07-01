<?php

namespace Kirby\Forum;

use Kirby\Toolkit\C;

// direct access protection
if(!defined('KIRBY')) die('Direct access is not allowed');

class Search {

  protected $query       = null;
  protected $options     = array();
  protected $searchwords = null;

  public function __construct($query = null) {

    $this->query = $query;

    $this->options = array(
      'minlength' => c::get('forum.search.minlength'),
      'stopwords' => c::get('forum.search.stopwords', array())
    );
  
  }

  public function searchwords() {

    if(!is_null($this->searchwords)) return $this->searchwords;

    $this->searchwords = preg_replace('/[^\pL]/u',',', preg_quote($this->query));
    $this->searchwords = str::split($this->searchwords, ',', $this->options['minlength']);

    if(!empty($this->options['stopwords'])) {
      $this->searchwords = array_diff($this->searchwords, $this->options['stopwords']);
    }

    return $this->searchwords;

  }

  public function results() {
    return array();    
  }


}