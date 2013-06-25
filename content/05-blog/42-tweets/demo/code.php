<?php $tweets = tweets('getkirby') ?>

<ul class="tweets">
  <?php foreach($tweets as $tweet): ?>
  <li>
    <a class="user" href="<?php echo $tweet->user()->url() ?>">
      <img src="<?php echo $tweet->user()->image() ?>" /> 
      <strong><?php echo $tweet->user()->name() ?></strong>
      <small>@<?php echo $tweet->user()->username() ?></small>
    </a>    
    <p><?php echo $tweet->text(true) ?></p>
    <a class="date" href="<?php echo $tweet->url() ?>"><?php echo $tweet->date('h:i A - d M y') ?></a>
  </li>
  <?php endforeach ?>
</ul>