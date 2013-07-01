<section class="main forum">

  <header class="forum-header">
    <h1>
      <a class="alpha" href="<?php echo $forum->url() ?>">Forum</a> <small>/</small>
      <a class="alpha" href="<?php echo $thread->url() ?>"><?php echo html($thread->title()) ?></a>
    </h1>

    <?php echo $forum->menu() ?>

  </header>

  <article class="topic details">

    <header class="topic-header">

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

    </header>

    <div class="text">
      <?php echo kirbytext($topic->text()) ?>
    </div>

    <section class="posts">

      <h1 class="is-invisible">Replies</h1>

      <?php foreach($topic->posts()->all() as $post): ?>
      <article class="post" id="post<?php echo $post->id() ?>">

        <header class="post-header">

          <figure class="user">
            <a href="<?php echo $post->user()->url() ?>"><img src="<?php echo $post->user()->avatar() ?>" /></a>
          </figure>

          <h1 class="delta"><a href="<?php echo $post->url() ?>"><small>Reply by</small> <?php echo $post->user()->username() ?></a></h1>

          <time class="added" datetime="<?php echo $post->added('c') ?>">
            <a href="<?php echo $post->url() ?>"><?php echo $post->added('d.m.Y - H:i') ?></a>
          </time>

        </header>

        <div class="text">
          <?php echo kirbytext($post->text()) ?>
        </div>

      </article>
      <?php endforeach ?>

    </section>

    <?php $forum->form('post') ?>

  </article>

</section>