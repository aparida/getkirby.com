<?php

namespace Kirby\Forum;

use Exception;
use Kirby\Toolkit\C;
use Kirby\Toolkit\Collection;
use Kirby\Toolkit\DB;
use Kirby\Toolkit\URI;
use Kirby\Toolkit\S;
use Kirby\Toolkit\TPL;
use Kirby\CMS\Pages;
use Kirby\Forum\User;
use Kirby\Forum\Users;
use Kirby\Forum\Auth;

// direct access protection
if(!defined('KIRBY')) die('Direct access is not allowed');

class Forum {

  // the parent page object
  protected $page = null;

  // cached properties
  protected $_user   = null;
  protected $_users  = null;
  protected $_search = null;

  public function __construct() {
    $uri        = c::get('forum.uri');
    $this->page = page($uri);
    $this->uri  = new URI(site()->uri()->toURL(), array(
      'subfolder' => site()->subfolder() . '/' . $uri
    ));

    db::connect(c::get('forum.db'));
 
  }

  static public function instance() {
    static $instance = null;
    if(!$instance) {
      $instance = new Forum();
    }
    return $instance;
  }

  /**
   * Returns the current user if logged in
   */
  public function user() {    
    if(!is_null($this->_user)) return $this->_user;
    return $this->_user = Auth::user();
  }

  /**
   * Returns all users
   * 
   * @return object
   */
  public function users() {
    if(!is_null($this->_users)) return $this->_users;
    return $this->_users = new Users();
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

  public function url($uri = '') {
    return rtrim($this->page->url() . '/' . $uri, '/');
  }

  public function search($searchword = null) {  
    if(!is_null($searchword))    return $this->_search = new Search($searchword);
    if(!is_null($this->_search)) return $this->_search;
    return $this->_search = new Search();
  }

  public function run() {

    $template = 'index';
    $thread   = false;
    $topic    = false;
    $post     = false;

    if($thread = $this->thread()) {
      $template = 'thread';
      
      if($topic = $this->topic()) {
        
        if(param('edit') == 'this') {

          // make sure that only authorized users may edit a topic
          if(!$topic->isEditable()) go($this->url());

          $template = 'topic.edit';        

        } else if($postID = param('edit-post')) {

          if($post = Posts::findByTopicAndId($topic, $postID)) {

            // make sure that only authorized users may edit this
            if(!$post->isEditable()) go($this->url());

            tpl::set('post', $post);
            $template = 'post.edit';            
          } else {      
            $template = 'topic';            
          }

        } else {
          
          // solve / unsolve topics
          if(param('solve') == 'this') {
            $topic->solve();
            go($topic->url());
          } else if(param('unsolve') == 'this') {
            $topic->unsolve();
            go($topic->url());
          }

          $template = 'topic';        

        }

      } else if($this->uri->path()->last() == 'topic') {

        // make sure that only authorized users may add new topics
        if(!$this->user()) go($this->url());

        $template = 'topic.new';
      }

    } else {

      switch($this->uri->path()->first()) {
        case 'login':
          // a template is only needed when an error occurs. 
          // otherwise the user will be redirected to the homepage
          $template = 'error';          
          // transfer the error message to the template
          tpl::set('error', Auth::login());
          break;
        case 'logout':        
          // logout the current user
          Auth::logout();
          // go back to the start page
          go($this->url());
          break;
        case 'search':
          $template = 'search';
          break;
      }

    }

    tpl::set(array(
      'page'    => $this->page,
      'forum'   => $this,
      'threads' => $this->threads(),
      'thread'  => $thread,
      'topic'   => $topic
    ));

    echo tpl::loadFile(KIRBY_PROJECT_ROOT_FORUM . DS . 'templates' . DS . $template . '.php');

  }

  public function menu() {  
    return static::snippet('menu', array('user' => $this->user()), $return = true);
  }

  static public function snippet($snippet, $data = array(), $return = false) {
    $html = tpl::loadFile(KIRBY_PROJECT_ROOT_FORUM . DS . 'snippets' . DS . $snippet . '.php', $data, true);
    if(!$return) {
      echo $html;
    } else {
      return $html;
    }
  }

  static public function form($name) {    
    // this will be replaced in the controller 
    // with the actual form object
    $form = null;
    // load the form controller
    require_once(KIRBY_FORUM_ROOT . DS . 'forms' . DS . $name . '.php');
    return $form;
  }

}