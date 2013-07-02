<?php

use Kirby\Form;
use Kirby\Forum\Post;

// check for an existing post
$post = tpl::get('post');

// define all form fields
$fields = array(
  'text' => array(
    'type'      => 'textarea',
    'autofocus' => ($post) ? true : false,
  )
);

// define the default notice for the form
$notice = false;

// on submit handler
if(r::is('POST') and csfr(get('csfr'))) {

  if($post) {

    // update the existing post
    $post->set(array(
      'text' => get('text')
    ));

  } else {
  
    // create a new post
    $post = new Post(array(
      'topic' => forum::instance()->topic()->id(),
      'user'  => forum::instance()->user()->id(),
      'added' => date('Y-m-d H:i:s'),
      'text'  => get('text')
    ));

  }
  
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

// set the form data
$data = ($post) ? $post->get() : get();

// set the submit button label
$submit = ($post) ? 'Update reply' : 'Publish reply';

// build the form
$form = new Form($fields, array(
  'data'    => $data,
  'notice'  => $notice,
  'buttons' => array(
    'cancel' => false, 
    'submit' => $submit
  )
));