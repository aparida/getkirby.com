<section class="main forum columns">

  <header class="forum-header">

    <h1>
      <a class="alpha" href="<?php echo $forum->url() ?>">Forum</a>
    </h1>

    <?php echo $forum->menu() ?>

  </header>

  <section> 

    <h1 class="is-invisible">Threads</h1>

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

  <section class="activity columns">
  
    <h1 class="is-invisible">Activity</h1>    

    <section class="column three">
      <header class="activity-header">
        <h1 class="gamma">Latest topics</h1>
      </header>

      <?php foreach($forum->latest('topics') as $topic): ?>
      <article class="topic">

        <header class="topic-header">

          <?php $forum->snippet('user', array('user' => $topic->user())) ?>

          <h1 class="delta"><a href="<?php echo $topic->url() ?>"><?php echo html($topic->title()) ?></a></h1>

          <time class="added" datetime="<?php echo $topic->added('c') ?>">
            <a href="<?php echo $topic->thread()->url() ?>"><em>Thread:</em> <?php echo html($topic->thread()->title()) ?></a>
            <a href="<?php echo $topic->url() ?>"><em>Added:</em> <?php echo $topic->added('d.m.Y - H:i') ?></a>
          </time>

        </header>

      </article>
      <?php endforeach ?>

    </section>

    <section class="column three last">
      <header class="activity-header">
        <h1 class="gamma">Latest replies</h1>
      </header>

      <?php foreach($forum->latest('posts') as $post): ?>
      <article class="post">

        <header class="post-header">

          <?php $forum->snippet('user', array('user' => $post->user())) ?>

          <h1 class="delta"><a href="<?php echo $post->url() ?>"><small>Reply by</small> <?php echo $post->user()->username() ?></a></h1>

          <time class="added" datetime="<?php echo $post->added('c') ?>">
            <a href="<?php echo $post->topic()->url() ?>"><em>Topic:</em> <?php echo html($post->topic()->title()) ?></a>
            <a href="<?php echo $post->url() ?>"><em>Added:</em> <?php echo $post->added('d.m.Y - H:i') ?></a>
          </time>

        </header>

      </article>
      <?php endforeach ?>

    </section>
  </section>

</section>