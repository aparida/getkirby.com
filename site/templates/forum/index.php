<section class="main columns forum">

  <header>
    <h1>
      <a class="alpha" href="<?php echo $forum->url() ?>">Forum</a>
    </h1>
  </header>

  <?php $count = 1; foreach($threads as $thread): ?>
  <article class="thread column three<?php e($count++%2==0, ' last') ?>">
    
    <h1 class="beta"><a href="<?php echo $thread->url() ?>"><?php echo html($thread->title()) ?></a></h1>

    <?php echo kirbytext($thread->text()) ?>

    <figure class="count">
      <a href="<?php echo $thread->url() ?>"><?php echo $thread->topics()->count() ?> Topics</a>
    </figure>

  </article>
  <?php endforeach ?>

</section>