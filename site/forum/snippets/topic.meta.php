<div class="meta">
  <a href="<?php echo $topic->user()->url() ?>"><?php echo $topic->user()->username() ?></a> 
  <small>/</small>
  <time class="added" datetime="<?php echo $topic->added('c') ?>">
    <a href="<?php echo $topic->url() ?>"><?php echo $topic->added('d.m.Y - H:i') ?></a>
  </time>
</div>