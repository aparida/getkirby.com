<?php

use Kirby\Form;
use Kirby\Forum\Topic;

// check for an existing topic
$topic = forum::instance()->topic();

// define the data for the form 
$data = ($topic) ? $topic->get() : get();

// set the label for the submit button
$submit = ($topic) ? 'Update topic' : 'Publish topic';

// define all form fields
$fields = array(
  'title' => array(
    'label'     => 'Title',
    'type'      => 'text', 
    'autofocus' => true,
  ),
  'text' => array(
    'label'     => 'Text',
    'type'      => 'textarea'
  )
);

// define the default notice for the form
$notice = false;

// on submit handler
if(r::is('POST') and csfr(get('csfr'))) {

  if($topic) {

    // update the existing topic
    $topic->set(array(
      'title' => get('title'), 
      'text'  => get('text')
    ));

  } else {

    // create a new topic
    $topic = new Topic(array(
      'thread' => forum::instance()->thread()->uid(),
      'user'   => forum::instance()->user()->id(),
      'added'  => date('Y-m-d H:i:s'),
      'title'  => get('title'),
      'text'   => get('text')
    ));
  
  }

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
  'data'    => $data,
  'notice'  => $notice,
  'buttons' => array(
    'cancel' => false, 
    'submit' => $submit
  )
));