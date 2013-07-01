<?php

use Kirby\Form;
use Kirby\Forum\Topic;

// define all form fields
$fields = array(
  'title' => array(
    'label' => 'Title',
    'type'  => 'text'
  ),
  'text' => array(
    'label' => 'Text',
    'type'  => 'textarea'
  )
);

// define the default notice for the form
$notice = false;

// on submit handler
if(r::is('POST') and csfr(get('csfr'))) {

  // create a new topic
  $topic = new Topic(array(
    'thread' => forum::instance()->thread()->uid(),
    'user'   => forum::instance()->user()->id(),
    'added'  => date('Y-m-d H:i:s'),
    'title'  => get('title'),
    'text'   => get('text')
  ));
  
  // try to save it and if saved redirect to its url
  if($topic->save()) {
    go($topic->url());
  } else {
    // create an error notice if it went wrong
    $notice = array(
      'type'    => 'error',
      'message' => $topic->error(),
    );
  }

}

// build the form
$form = new Form($fields, array(
  'data'    => get(),
  'notice'  => $notice,
  'buttons' => array(
    'cancel' => false, 
    'submit' => 'Add'
  )
));