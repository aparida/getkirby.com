<?php

// direct access protection
if(!defined('KIRBY')) die('Direct access is not allowed');

/**
 * Blog default config
 */
c::set(array(

  // relative url where the blog is located
  'blog.uri' => 'blog',

  'blog.template.index'    => 'blog',
  'blog.template.article'  => 'blog.article',
  'blog.template.feed'     => 'blog.feed',
  'blog.template.archive'  => 'blog.archive',

  // pagination setup
  'blog.limit.articles' => 20,

));