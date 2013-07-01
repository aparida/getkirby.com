<?php

namespace Kirby\Forum;

use Exception;
use TwitterOAuth;
use Kirby\Toolkit\C;
use Kirby\Toolkit\S;
use Kirby\Toolkit\Server;
use Kirby\Forum\User;

// direct access protection
if(!defined('KIRBY')) die('Direct access is not allowed');

class Auth {

  static public function login() {

    // load the oauth wrapper if not installed as a pecl module
    if(c::get('forum.oauth.pecl') == false) require_once(KIRBY_FORUM_ROOT_VENDORS . DS . 'oauth' . DS . 'oauth.php');
    
    // load the twitter oauth class
    require_once(KIRBY_FORUM_ROOT_VENDORS . DS . 'twitter' . DS . 'twitter.php');

    try {

      // on callbacks
      if(param('step') == 'callback') {
        static::callback(); 
      } else {
        static::authorize();
      }    

    } catch(Exception $e) {
      static::logout();
      return $e->getMessage();
    }

  }

  static protected function authorize() {

    // Build TwitterOAuth object with client credentials
    $connection = new TwitterOAuth(
      c::get('forum.twitter.key'), 
      c::get('forum.twitter.secret')
    );
  
    // get the referer to maybe link back
    $referer = server::get('http_referer');
  
    if(preg_match('!^' . preg_quote(Forum::instance()->url()) . '!i', $referer)) {
      $redirect = '?redirect=' . urlencode($referer);
    } else {
      $redirect = false;
    }
  
    try {           
      // Get temporary credentials and set the callback url
      $request_token = $connection->getRequestToken(Forum::instance()->url() . '/login/step:callback' . $redirect);
    } catch(Exception $e) {
      raise('Could not connect to Twitter. Refresh the page or try again later.');
    }
          
    // Save temporary credentials to session.
    s::set('forum.oauth.token',        $request_token['oauth_token']);
    s::set('forum.oauth.token.secret', $request_token['oauth_token_secret']);
     
    // If last connection failed don't display authorization link.
    if($connection->http_code != 200) {
      raise('Could not connect to Twitter. Refresh the page or try again later.');
    }
    
    // go to twitter to authenticate
    go($connection->getAuthorizeURL(s::get('forum.oauth.token')));

  }

  static protected function callback() {

    // If the oauth_token is old redirect to the connect page.
    if(get('oauth_token') !== s::get('forum.oauth.token')) {
      raise('Invalid OAuth Token');
    }

    // Create TwitteroAuth object with app key/secret and token key/secret from default phase
    $connection = new TwitterOAuth(
      c::get('forum.twitter.key'), 
      c::get('forum.twitter.secret'), 
      s::get('forum.oauth.token'), 
      s::get('forum.oauth.token.secret')
    );
          
    // Request access tokens from twitter
    $access = $connection->getAccessToken(get('oauth_verifier'));
    
    // If HTTP response is 200 continue otherwise send to connect page to retry
    if($connection->http_code != 200) {
      raise('Invalid OAuth callback');
    }
          
    // generate a user array
    $data = array(
      'tid'      => $access['user_id'],
      'username' => $access['screen_name'],
      'token'    => $access['oauth_token'],
      'secret'   => $access['oauth_token_secret'],
      'login'    => date('Y-m-d H:i:s')
    );      
    
    // check for an existing user
    $user = Users::findByTwitterId($data['tid']);
    
    if(empty($user)) {
      
      $user = new User($data);
      $user->added = date('Y-m-d H:i:s');

      if(!$user->save()) {
        raise('The user information could not be saved');
      }
                            
    } else {

      // update all data from twitter
      $user->set($data);
      $user->save();

    }
          
    // store the user in the session
    s::set('forum.user', $user->id());            
    
    // check for a valid redirect url to send to after everything went fine
    if(preg_match('!^' . preg_quote(Forum::instance()->url()) . '!i', get('redirect'))) {
      $redirect = urldecode(get('redirect'));
    } else {
      $redirect = Forum::instance()->url();
    }
    
    // go back to the forum homepage                                                                      
    go($redirect);

  }

  static public function logout() {
    s::set('forum.oauth.token', false);
    s::set('forum.oauth.token.secret', false);
    s::set('forum.user', false);            
  }

  static public function user() {
    if($id = s::get('forum.user') && s::get('forum.oauth.token') && s::get('forum.oauth.token.secret')) {    
      return Users::findById($id);
    } else {
      return false;
    }
  }

}