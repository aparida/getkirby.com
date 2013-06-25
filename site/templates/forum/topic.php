<div class="main forum">

  <header>
    <h1>
      <a class="alpha" href="<?php echo $forum->url() ?>">Forum</a> <small>/</small>
      <a class="alpha" href="<?php echo $thread->url() ?>"><?php echo html($thread->title()) ?></a>
    </h1>
  </header>

  <article class="topic-details">

    <header>

      <figure class="user">
        <a href="<?php echo $topic->user()->url() ?>"><img src="<?php echo $topic->user()->avatar() ?>" /></a>
      </figure>

      <h1 class="beta">
        <a href="<?php echo $topic->url() ?>"><?php echo html($topic->title()) ?></a>
      </h1>

      <time class="added" datetime="<?php echo $topic->added('c') ?>">
        <a href="<?php echo $topic->url() ?>"><?php echo $topic->added('d.m.Y - H:i') ?></a>
      </time>

    </header>

    <div class="text">
      <?php echo kirbytext($topic->text()) ?>
    </div>

    <section class="posts">

      <h1 class="beta">Replies</h1>

      <ul>
        <?php foreach($topic->posts()->all() as $post): ?>
        <li class="post">

          <figure class="user">
            <a href="<?php echo $post->user()->url() ?>"><img src="<?php echo $post->user()->avatar() ?>" /></a>
          </figure>

          <time class="added" datetime="<?php echo $post->added('c') ?>">
            <a href="<?php echo $post->url() ?>"><?php echo $post->added('d.m.Y - H:i') ?></a>
          </time>

          <div class="text">
            <?php echo kirbytext($post->text()) ?>
          </div>

        </li>
        <?php endforeach ?>
      </ul>

    </section>

    <section class="post-form">

      <h1 class="beta">Your Reply</h1>

    </section>

  </article>

</div>