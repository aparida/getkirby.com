<?php

// direct access protection
if(!defined('KIRBY')) die('Direct access is not allowed');

/**
 * Forum default config
 */
c::set(array(

  // relative url where the forum is located
  'forum.uri' => 'forum',

  // database setup 
  'forum.db' => array(
    'host'     => '127.0.0.1',
    'user'     => 'root',
    'password' => '',
    'database' => 'kirbyforum', 
    'type'     => 'mysql'
  ),

  // twitter oauth credentials
  'forum.twitter.key'    => false,
  'forum.twitter.secret' => false,
  
  'forum.oauth.pecl'     => true,

  // user setup
  'forum.banned'         => array(),
  'forum.admins'         => array(),

  // pagination setup
  'forum.limit.topics'   => 40,
  'forum.limit.posts'    => 20

));