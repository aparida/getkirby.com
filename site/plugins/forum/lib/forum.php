<?php

namespace Kirby\Forum;

use Kirby\Toolkit\Collection;
use Kirby\Toolkit\DB;
use Kirby\Toolkit\URI;
use Kirby\Toolkit\TPL;
use Kirby\CMS\Pages;
use Kirby\Forum\Users;

// direct access protection
if(!defined('KIRBY')) die('Direct access is not allowed');

class Forum {

  protected $page  = null;
  protected $users = null;

  public function __construct($uri = 'support/forum') {
    $this->page = page($uri);
    $this->uri  = new URI(site()->uri()->toURL(), array(
      'subfolder' => site()->subfolder() . '/' . $uri
    ));

    db::connect(array(
      'host'     => '127.0.0.1', 
      'user'     => 'root',
      'password' => '',
      'database' => 'kirbyforum',
      'type'     => 'mysql'
    ));
 
  }

  static public function instance() {
    static $instance = null;
    if(!$instance) {
      $instance = new Forum('support/forum');
    }
    return $instance;
  }

  /**
   * Returns all users
   * 
   * @return object
   */
  public function users() {
    if(!is_null($this->users)) return $this->users;
    return $this->users = new Users();
  }

  /**
   * Returns all threads
   * 
   * @return object
   */
  public function threads() {

    $threads = array();
    
    foreach($this->page->children()->visible() as $page) {        
      $threads[$page->uri()] = new Thread($page->root());
    }

    return new Pages($threads);

  }

  /**
   * Returns the currently active thread
   * 
   * @return object
   */
  public function thread() {
    $folder = $this->uri->path()->first();    
  
    if(empty($folder)) return false;
    
    if($page = $this->threads()->findByUID($folder)) {
      return new Thread($page->root());
    } else {
      return false;
    }
  
  }

  /**
   * Returns the currently active topic
   * 
   * @return object
   */
  public function topic() {

    // get the topic id from the url
    $topicID = param('topic');

    if($topicID && $thread = $this->thread()) {
      return $thread->topics()->findByID($topicID);
    }

    return false;

  }

  public function url() {
    return $this->page->url();
  }

  public function run() {

    $template = 'index';
    $thread   = false;
    $topic    = false;
    $post     = false;

    if($thread = $this->thread()) {
      $template = 'thread';
      
      if($topic = $this->topic()) {
        $template = 'topic';        
      }
    
    } else {

      switch($this->uri->path()->first()) {
        case 'auth':
          $template = 'login';
          break;
        case 'search':
          $template = 'search';
          break;
      }

    }

    echo tpl::load('forum/' . $template, array(
      'page'    => page('support/forum'),
      'forum'   => $this,
      'threads' => $this->threads(),
      'thread'  => $thread,
      'topic'   => $topic
    ));

  }

}