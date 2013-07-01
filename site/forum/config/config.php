<?php

c::set(array(

  // relative url where the forum is located
  'forum.uri' => 'support/forum',

  // database setup 
  'forum.db' => array(
    'host'     => '127.0.0.1',
    'user'     => 'root',
    'password' => '',
    'database' => 'kirbyforum', 
    'type'     => 'mysql'
  ),

  // twitter oauth credentials
  'forum.twitter.key'    => '1XaIUbRzNNW1dR6h6YdN0g',
  'forum.twitter.secret' => 'rewbudlGlJvDEkK0jw2q6cfaoFZoJ7G8hLlif15t6o',
  
  'forum.oauth.pecl'     => true,

  // user setup
  'forum.banned'         => array(),
  'forum.admins'         => array('bastianallgeier'),

  // pagination setup
  'forum.limit.topics'   => 40,
  'forum.limit.posts'    => 20

));