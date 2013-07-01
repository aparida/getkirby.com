<?php

use Kirby\Form;
use Kirby\Forum\Post;

// define all form fields
$fields = array(
  'text' => array(
    'type' => 'textarea'
  )
);

// define the default notice for the form
$notice = false;

// on submit handler
if(r::is('POST') and csfr(get('csfr'))) {

  // create a new post
  $post = new Post(array(
    'topic' => forum::instance()->topic()->id(),
    'user'  => forum::instance()->user()->id(),
    'added' => date('Y-m-d H:i:s'),
    'text'  => get('text')
  ));
  
  // try to save it and if saved redirect to its url
  if($post->save()) {
    go($post->url());
  } else {
    // create an error notice if it went wrong
    $notice = array(
      'type'    => 'error',
      'message' => $post->error(),
    );
  }

}

// build the form
$form = new Form($fields, array(
  'data'    => get(),
  'notice'  => $notice,
  'buttons' => array(
    'cancel' => false, 
    'submit' => 'Post'
  )
));