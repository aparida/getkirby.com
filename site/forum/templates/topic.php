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

        <?php $forum->snippet('topic.header', array('topic' => $topic)) ?>        

        <div class="text">
          <?php echo kirbytext($topic->text()) ?>
        </div>

      </div>

      <aside class="sidebar column two last">

        <h1 class="is-invisible">Topic navigation</h1>

        <ul>
          <li><a href="<?php echo $thread->url() ?>"><small>↑</small>Back to the thread</a></li>

          <?php if($topic->isEditable()): ?>
          <li><a href="<?php echo $topic->url() ?>/edit:this"><small>✎</small>Edit this topic</a></li>
          <?php if($topic->solved()): ?>
          <li><a href="<?php echo $topic->url() ?>/unsolve:this"><small>✘</small>Reopen this topic</a></li>
          <?php else: ?>
          <li><a href="<?php echo $topic->url() ?>/solve:this"><small>✔</small>Mark as solved</a></li>
          <?php endif ?>
          <?php endif ?>

        </ul>

      </aside>

    </div>

    <section class="posts">

      <h1 class="is-invisible">Replies</h1>

      <?php foreach($topic->posts()->all() as $post): ?>
      <article class="post columns" id="post<?php echo $post->id() ?>">

        <div class="column four">
  
          <header class="post-header">

            <?php $forum->snippet('user', array('user' => $post->user())) ?>

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
            <?php if($post->isEditable()): ?>
            <li><a href="<?php echo $topic->url() ?>/edit-post:<?php echo $post->id() ?>"><small>✎</small>Edit this reply</a></li>
            <?php endif ?>
          </ul>

        </aside>


      </article>
      <?php endforeach ?>

    </section>

    <section class="post-form" id="reply">

      <header class="post-header">

        <?php if(!$forum->user()): ?>
        <figure class="user no-user">
          <a href="<?php echo $forum->url('login') ?>">?</a>
        </figure>
        <?php else: ?>
        <?php $forum->snippet('user', array('user' => $forum->user())) ?>
        <?php endif ?>

        <h1 class="delta">Your Reply</h1>

        <time class="added" datetime="<?php echo date('c') ?>">
          Right now…
        </time>

      </header>

      <?php if($forum->user()): ?>
      <?php echo $forum->form('post') ?>
      <?php else: ?>
      <p class="text">Please <a href="<?php echo $forum->url('login') ?>">login via Twitter</a> to post a reply</p>
      <?php endif ?>
        
    </section>

  </article>

</section>