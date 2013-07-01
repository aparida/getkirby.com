<section class="main forum">

  <header class="forum-header">
    <h1>
      <a class="alpha" href="<?php echo $forum->url() ?>">Forum</a> <small>/</small>
      <a class="alpha" href="<?php echo $thread->url() ?>"><?php echo html($thread->title()) ?></a>
    </h1>

    <?php echo $forum->menu() ?>

  </header>

  <article class="topic details">

    <div class="columns">
      <div class="column four">
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
      </div>

      <aside class="sidebar column two last">

        <h1 class="is-invisible">Topic navigation</h1>

        <ul>
          <li><a href=""><small>↑</small>Back to the thread</a></li>
          <li><a href=""><small></small>Edit this topic</a></li>
          <li><a href=""><small></small>Mark as solved</a></li>
        </ul>

      </aside>

    </div>

    <section class="posts">

      <h1 class="is-invisible">Replies</h1>

      <?php foreach($topic->posts()->all() as $post): ?>
      <article class="post columns" id="post<?php echo $post->id() ?>">

        <div class="column four">
  
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

        </div>

        <aside class="sidebar column two last">

          <h1 class="is-invisible">Post navigation</h1>

          <ul>
            <li><a href="<?php echo $post->url() ?>"><small>#</small>Direct link</a></li>
            <?php if($forum->user()): ?>
            <li><a href=""><small></small>Edit this reply</a></li>
            <?php endif ?>
          </ul>

        </aside>


      </article>
      <?php endforeach ?>

    </section>

    <?php $forum->form('post') ?>

  </article>

</section>