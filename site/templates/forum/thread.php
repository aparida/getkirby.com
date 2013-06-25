<section class="main forum">

  <header>
    <h1>
      <a class="alpha" href="<?php echo $forum->url() ?>">Forum</a> <small>/</small>
      <a class="alpha is-active" href="<?php echo $thread->url() ?>"><?php echo html($thread->title()) ?></a>
    </h1>
  </header>

  <?php foreach($thread->topics()->page(param('page'), 20) as $topic): ?>
  <article class="topic">

    <figure class="user">
      <a href="<?php echo $topic->user()->url() ?>"><img src="<?php echo $topic->user()->avatar() ?>" /></a>
    </figure>

    <h1 class="delta"><a href="<?php echo $topic->url() ?>"><?php echo html($topic->title()) ?></a></h1>

    <div class="meta">
      <a href=""><?php echo $topic->user()->username() ?></a> &rsaquo; 
      <time class="added" datetime="<?php echo $topic->added('c') ?>">
        <a href=""><?php echo $topic->added('d.m.Y - H:i') ?></a>
      </time>
    </div>

    <figure class="count">
      <a href="<?php echo $topic->url() ?>"><?php echo $topic->posts()->count() ?> Replies</a>
    </figure>

  </article>
  <?php endforeach ?>

</section>