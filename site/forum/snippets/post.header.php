<header class="post-header">

  <?php $forum->snippet('user', array('user' => $post->user())) ?>

  <h1 class="delta"><a href="<?php echo $post->url() ?>"><small>Reply by</small> <?php echo $post->user()->username() ?></a></h1>

  <time class="added" datetime="<?php echo $post->added('c') ?>">
    <a href="<?php echo $post->url() ?>"><?php echo $post->added('d.m.Y - H:i') ?></a>
  </time>

</header>
