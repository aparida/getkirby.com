<?php

// direct access protection
if(!defined('KIRBY')) die('Direct access is not allowed');

s::start();

class forum extends page {
  
  function __construct($uid) {
    
    global $site;
    
    $obj     = $site->pages()->find($uid);
    $this->_ = $obj->_;
        
  }

  function threads() {
    
    $result = array();
    
    foreach($this->children()->visible() as $thread) {
      $result[] = new forumThread($thread, $this);
    }
    
    return $result;
    
  }  
  
  function thread($page=false) {
    
    global $site;
    if(!$page) $page = $site->pages()->active();
    
    return new forumThread($page, $this);
          
  }

  function news() {
    
    global $site;        
        
    // fetch the raw data from the db
    $topics  = db::select('topics', 'id, thread', false, 'added desc', 0, 20);
    $replies = db::select('posts', 'id, topic', false, 'added desc', 0, 20);
    $result  = array();    
    
    foreach($topics as $topic) {
      
      $thread = $this->thread($site->pages()->find('forum/' . $topic['thread']));
      $t = new forumTopic($topic['id'], $thread);
      $t->title = 'New topic: ' . $t->title; 
      $t->text  = $t->text . "\n\n" . ' <strong>Posted by: <a href="' . $t->user()->url() . '">' . $t->user()->username() . '</a></strong>';

      $result[$t->added()] = $t;

    }

    foreach($replies as $reply) {
          
      $r = new forumPost($reply['id'], false);
      $r->title = 'New reply for: ' . $r->topic()->title();
      $r->text  = $r->text . "\n\n" . ' <strong>Reply by: <a href="' . $r->user()->url() . '">' . $r->user()->username() . '</a></strong>';
      
      $result[$r->added()] = $r;

    }
    
    krsort($result);
    return $result;
               
  }
  
  function auth() {
    
    // if the user is already signed in…
    if($this->user()) {
      // logout if the do param is set
      if(param('do') == 'logout') $this->logout();
      
      // go back to the forum homepage
      go($this->url());
    }

    if(c::get('forum.oauth.pecl') == false) require_once('forum/oauth.php');
    require_once('forum/twitteroauth.php');

    // on callbacks
    if(param('status') == 'callback') {
    
      // If the oauth_token is old redirect to the connect page.
      if(get('oauth_token') !== s::get('oauth_token')) {
        $this->logout();
        return array(
          'status' => 'error',
          'msg'    => 'Invalid token'      
        );
      }

      // Create TwitteroAuth object with app key/secret and token key/secret from default phase
      $connection = new TwitterOAuth(c::get('forum.twitter.key'), c::get('forum.twitter.secret'), s::get('oauth_token'), s::get('oauth_token_secret'));
            
      // Request access tokens from twitter
      $access = $connection->getAccessToken(get('oauth_verifier'));
      
      // If HTTP response is 200 continue otherwise send to connect page to retry
      if($connection->http_code != 200) {
        $this->logout();
        return array(
          'status' => 'error',
          'msg'    => 'Invalid callback'
        );
      }
            
      // generate a user array
      $user = array(
        'tid'      => $access['user_id'],
        'username' => $access['screen_name'],
        'token'    => $access['oauth_token'],
        'secret'   => $access['oauth_token_secret'],
        'login'    => date('Y-m-d H:i:s')
      );      

      if(in_array($user['username'], c::get('forum.banned', array()))) {
        $this->logout();
        return array(
          'status' => 'error',
          'msg'    => 'Your account is banned'
        );
      }
      
      // check for an existing user
      $data = db::row('users', '*', array('tid' => $user['tid']));
      
      if(empty($data)) {
        // create a new user entry in the db
        
        $user['added'] = 'NOW()';
        $id = db::insert('users', $user);                
        
        if(!$id) return array(
          'status' => 'error',
          'msg'    => 'The user information could not be saved'
        );
        
        // add the id
        $user['id'] = $id;
                      
      } else {
        // update an existing entry      
        db::update('users', $user, array('tid' => $user['tid']));

        // add the id
        $user['id'] = $data['id'];
      }
            
      // store the user in the session
      s::set('user', $user);            
      
      // check for a valid redirect url to send to after everything went fine
      if(preg_match('!^' . preg_quote($this->url()) . '!i', get('redirect'))) {
        $redirect = urldecode(get('redirect'));
      } else {
        $redirect = $this->url();
      }
      
      // go back to the forum homepage                                                                      
      go($redirect);

    } else {
                
      // Build TwitterOAuth object with client credentials
      $connection = new TwitterOAuth(c::get('forum.twitter.key'), c::get('forum.twitter.secret'));
    
      // get the referer to maybe link back
      $referer = server::get('http_referer');
    
      if(preg_match('!^' . preg_quote($this->url()) . '!i', $referer)) {
        $redirect = '?redirect=' . urlencode($referer);
      } else {
        $redirect = false;
      }
    
      try {           
        // Get temporary credentials and set the callback url
        $request_token = $connection->getRequestToken($this->url() . '/auth/status:callback' . $redirect);
      } catch(Exception $e) {
        $this->logout();
        return array(
          'status' => 'error',
          'msg'    => 'Could not connect to Twitter. Refresh the page or try again later.'
        );      
      }
            
      // Save temporary credentials to session.
      s::set('oauth_token', $request_token['oauth_token']);
      s::set('oauth_token_secret', $request_token['oauth_token_secret']);
       
      // If last connection failed don't display authorization link.
      if($connection->http_code != 200) {
        $this->logout();
        return array(
          'status' => 'error',
          'msg'    => 'Could not connect to Twitter. Refresh the page or try again later.'
        );
      }
      
      // go to twitter to authenticate
      go($connection->getAuthorizeURL(s::get('oauth_token')));

    }
  
  }
    
  function user() {
    
    $user = s::get('user');
    if(
      empty($user['tid']) || 
      empty($user['username']) || 
      empty($user['id']) || 
      empty($user['token']) || 
      empty($user['secret'])) {
      
      s::set('user', false);
      return $this->user = false;
    }

    if($this->user) return $this->user;
    return $this->user = new forumUser($user['id']);
          
  }    
    
  function logout() {
    $this->user = false;
    s::set('oauth_token', false);
    s::set('oauth_token_secret', false);
    s::set('user', false);    
  }

  function search() {
    return new forumSearch();
  }
      
}

class forumThread extends page {
    
  function __construct($page, $forum=false) {
    $this->_ = $page->_;
    $this->forum = ($forum) ? $forum : new forum('forum');
  }

  function topics() {
    if($this->topics) return $this->topics;
    return $this->topics = new forumTopics($this);                  
  }

  function countTopics() {
    return $this->topics()->count();
  }
    
  function topic($id=false) {
    if(!$id) $id = param('topic');
    if(!$id) return false;
    $topic = new forumTopic($id, $this);    
    
    if(!$topic->id()) return false;
    return $topic;    
  }

  function addTopic() {
    
    if(!get('submit')) return false;
    
    $forum = $this->forum();
            
    if(!$forum->user()) return array(
      'status' => 'error',
      'msg'    => 'Please login first'    
    );
    
    $title = get('title');
    $text  = get('text');

    if(str::length($title) < 2) return array(
      'status' => 'error',
      'msg'    => 'Please enter a title'          
    );
    
    if(str::length($text) < 2) return array(
      'status' => 'error',
      'msg'    => 'Please enter some text'          
    );

    $uid = str::urlify($title);
    
    $input = array(
      'thread' => $this->uid(),
      'title'  => $title,
      'text'   => $text,
      'user'   => $forum->user()->id(),
      'added'  => 'NOW()'
    );
    
    $id = db::insert('topics', $input);

    if(!$id) return array(
      'status' => 'error',
      'msg'    => 'Your topic could not be posted'          
    );
       
    $topic = new forumTopic($id, $this);
    go($topic->url());
      
  }

  function editTopic($topic) {
    
    if(!get('submit')) return false;
    
    $forum = $this->forum();
            
    if(!$forum->user()) return array(
      'status' => 'error',
      'msg'    => 'Please login first'    
    );

    if(!$topic->isEditable()) return array(
      'status' => 'error',
      'msg'    => 'You are not allowed to edit this topic'    
    );

    
    $title = get('title');
    $text  = get('text');

    if(str::length($title) < 2) return array(
      'status' => 'error',
      'msg'    => 'Please enter a title'          
    );
    
    if(str::length($text) < 2) return array(
      'status' => 'error',
      'msg'    => 'Please enter some text'          
    );

    $uid = str::urlify($title);
    
    $input = array(
      'title'  => $title,
      'text'   => $text,
    );
    
    db::update('topics', $input, array('id' => $topic->id()));
    go($topic->url());
      
  }
  
}

class forumTopics extends obj {

  var $thread     = null;
  var $data       = null;
  var $count      = 0;
  var $pagination = null;

  function __construct($thread) {
        
    $this->thread = $thread;    
    $this->count  = db::count('topics', array('thread' => $this->thread->uid()));

    // add pagination
    $this->pagination = new forumPagination($this->count, c::get('forum.limit.topics', 40));

    // fetch the raw data from the db
    $this->data = db::select('topics', 'id', array('thread' => $thread->uid()), 'added desc', $this->pagination->offset, $this->pagination->limit);
    
    foreach($this->data as $topic) {
      $this->_[] = new forumTopic($topic['id'], $this->thread);
    }
          
  }

  function pagination() {
    return $this->pagination;
  }

  function count() {
    return $this->count;  
  }

}

class forumTopic extends obj {
  
  var $data   = false;
  var $thread = false;
    
  function __construct($id, $thread=false) {
    $this->data = db::row('topics', '*', array('id' => $id));
    parent::__construct($this->data);
    $this->thread = ($thread) ? $thread : $this->thread();
  }

  function thread() {

    global $site;

    if($this->thread) return $this->thread;
    
    $forum = new forum('forum');
    return new forumThread($forum->children()->find($this->data['thread']), $forum);    

  }
    
  function url() {
    return $this->thread()->url() . '/topic:' . $this->id();
  }    
  
  function user() {
    return new forumUser($this->user);
  }
  
  function added($format=false) {
    $ts = strtotime($this->added);
    if(!$format) return $ts;
    return date($format, $ts);
  }
  
  function text() {
    return (string)$this->text;
  }
    
  function posts() {
    if($this->posts) return $this->posts;
    return $this->posts = new forumPosts($this);                  
  }

  function countPosts() {
    return $this->posts()->count();
  }
  
  function addPost() {
    
    if(!get('submit')) return false;
    
    $forum = $this->thread()->forum();
            
    if(!$forum->user()) return array(
      'status' => 'error',
      'msg'    => 'Please login first'    
    );
    
    $text = get('text');
    
    if(str::length($text) < 2) return array(
      'status' => 'error',
      'msg'    => 'Please enter some text'          
    );
    
    $input = array(
      'topic' => $this->id(),
      'text'  => $text,
      'user'  => $forum->user()->id(),
      'added' => 'NOW()'
    );
    
    $id = db::insert('posts', $input);

    if(!$id) return array(
      'status' => 'error',
      'msg'    => 'Your reply could not be posted'          
    );

    $post = new forumPost($id, $this);

    if(!$post->data) return array(
      'status' => 'error',
      'msg'    => 'Your reply could not be posted'          
    );
              
    go($post->url());
      
  }

  function editPost($post) {
    
    if(!get('submit')) return false;
    
    $forum = $this->thread()->forum();
            
    if(!$forum->user()) return array(
      'status' => 'error',
      'msg'    => 'Please login first'    
    );

    if(!$post->isEditable()) return array(
      'status' => 'error',
      'msg'    => 'You are not allowed to edit this reply'    
    );
    
    $text = get('text');
    
    if(str::length($text) < 2) return array(
      'status' => 'error',
      'msg'    => 'Please enter some text'          
    );
    
    $input = array(
      'text' => $text
    );
    
    db::update('posts', $input, array('id' => $post->id()));
              
    go($post->url());
      
  }
  
  function isEditable() {

    $forum = $this->thread()->forum();

    if(!$forum->user()) return false;

    // check 
    if($forum->user() == $this->user() || $forum->user()->admin()) return true;
    
    return false;
        
  }

  function isSolved() {
    return ($this->solved() > 0) ? true : false;
  }

  function markAsSolved() {    
    if(!$this->isEditable()) return false;
    db::update('topics', array('solved' => 1), array('id' => $this->id));
  }

  function markAsUnsolved() {
    if(!$this->isEditable()) return false;
    db::update('topics', array('solved' => ''), array('id' => $this->id));
  }
  
}

class forumPosts extends obj {

  var $thread     = null;
  var $topic      = null;
  var $data       = null;
  var $count      = 0;
  var $pagination = null;

  function __construct($topic) {
                
    $this->thread = $topic->thread();    
    $this->topic  = $topic;
    $this->count  = db::count('posts', array('topic' => $this->topic->id()));

    // add pagination
    $this->pagination = new forumPagination($this->count, c::get('forum.limit.posts', 20));

    // fetch the raw data from the db
    $this->data = db::select('posts', 'id', array('topic' => $this->topic->id()), 'added asc', $this->pagination->offset, $this->pagination->limit);
        
    foreach($this->data as $post) {
      $this->_[] = new forumPost($post['id'], $this->topic);
    }
          
  }
  
  function pagination() {
    return $this->pagination;
  }

  function count() {
    return $this->count;  
  }

}

class forumPost extends obj {

  var $data  = false;
  var $topic = false;
  
  function __construct($id, $topic=false) {
    $this->data = db::row('posts', '*', array('id' => $id));
    parent::__construct($this->data);

    // find the matching topic
    $this->topic = (!$topic) ? $this->topic() : $topic;
  }

  function topic() {
    if($this->topic) return $this->topic;
    return new forumTopic($this->data['topic'], null);    
  }

  function url() {
    return $this->topic()->url() . '/#post' . $this->id();
  }    
  
  function user() {
    return new forumUser($this->user);
  }
  
  function added($format=false) {
    $ts = strtotime($this->added);
    if(!$format) return $ts;
    return date($format, $ts);
  }

  function text() {
    return (string)$this->text;
  }

  function isEditable() {

    $forum = $this->topic()->thread()->forum();

    if(!$forum->user()) return false;

    // check 
    if($forum->user() == $this->user() || $forum->user()->admin()) return true;
    return false;
        
  }
  
}

class forumUser extends obj {
  
  function __construct($id) {
    $data = db::row('users', '*', array('id' => $id));
    $this->_ = $data;
  }

  function url() {
    return 'http://twitter.com/' . $this->username();
  }
  
  function avatar() {
    return 'http://twitter.com/api/users/profile_image/' . $this->username();  
  }
  
  function admin() {
    return (in_array($this->username(), c::get('forum.admins', array()))) ? true : false;
  }
  
}

class forumPagination extends pagination {

  function __construct($count, $limit, $options=array()) {

    global $site;
        
    $this->pagevar = c::get('pagination.variable', 'page');
    $this->mode    = a::get($options, 'mode', c::get('pagination.method', 'params')) == 'query' ? 'query' : 'params';
    $this->count   = $count;
    $this->limit   = $limit;
    $this->page    = ($this->mode == 'query') ? intval(get($this->pagevar)) : intval($site->uri->param($this->pagevar));
    $this->pages   = ceil($this->count / $this->limit);

    // sanitize the page
    if($this->page < 1) $this->page = 1;

    // if($this->page > $this->pages && $this->count > 0) go($this->firstPageURL());

    // generate the offset
    $this->offset = ($this->page-1)*$this->limit;  
    
  }

  function countItems() {
    return $this->count;
  }

}

class ForumSearch {
  
  protected $query       = null;
  protected $searchwords = null;
  protected $options     = null;
  protected $topics      = null;
  protected $replies     = null;

  public function __construct($params = array()) {

    $defaults = array(
      'minlength' => 2,
      'stopwords' => array(), 
      'variable'  => 'q',
    );

    $this->options = array_merge($defaults, $params);
    $this->query   = get($this->options['variable']);

  }  

  public function query() {
    return $this->query;
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

  public function isValid() {
    return count($this->searchwords()) > 0 ? true : false;
  }

  public function searching() {
    return (!empty($this->query)) ? true : false;
  }

  public function topics() {
    
    if(!is_null($this->topics)) return $this->topics;  

    $results = false;

    if($this->isValid()) {
      $results = $this->results('ForumTopic', 'topics', array('title','text'));
    }

    return $this->topics = $results;
  
  }

  public function replies() {

    if(!is_null($this->replies)) return $this->replies;  

    $results = false;

    if($this->isValid()) {
      $results = $this->results('ForumPost', 'posts', array('text'));
    }

    return $this->replies = $results;
  
  }

  protected function searchClause($searchfields = array()) {
    $clause = array();      
    foreach($this->searchwords as $sw) {
      $clause[] = db::search_clause($sw, $searchfields);
    }
    return implode(' OR ', $clause);
  }

  protected function results($object, $table, $searchfields) {
    return new ForumSearchResults($object, $table, $this->searchClause($searchfields)); 
  }

}

class ForumSearchResults extends obj {

  protected $data       = null;
  protected $count      = 0;
  protected $pagination = null;

  public function __construct($object, $table, $clause) {
        
    // add pagination
    //$this->pagination = new ForumPagination($this->count, 30);

    // fetch the raw data from the db
    $this->data  = db::select($table, 'id', $clause, 'added desc', 0, 20);
    $this->count = count($this->data);
    
    foreach($this->data as $row) {
      $this->_[] = new $object($row['id']);
    }
          
  }

  public function pagination() {
    return $this->pagination;
  }

  public function count() {
    return $this->count;  
  }

}

?>