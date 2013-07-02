<?php

use Kirby\Form;

// define all form fields
$fields = array(
  'q' => array(
    'placeholder' => 'Search the forum…',
    'type'        => 'text', 
    'autofocus'   => true
  )
);

// define the default notice for the form
$notice = false;

// on submit handler
if(r::is('GET') and csfr(get('csfr'))) {
  forum::instance()->search(get('q'));
}

// build the form
$form = new Form($fields, array(
  'data'    => get(),
  'method'  => 'GET',
  'csfr'    => false,
  'buttons' => array(    
    'cancel' => false, 
    'submit' => 'Search'
  )
));