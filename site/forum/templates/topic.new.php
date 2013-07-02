<section class="main forum columns">

  <header class="forum-header">
    <h1>
      <a class="alpha" href="<?php echo $forum->url() ?>">Forum</a> <small>/</small>
      <a class="alpha" href="<?php echo $thread->url() ?>"><?php echo html($thread->title()) ?></a>
    </h1>

    <?php echo $forum->menu() ?>
  </header>

  <section class="topic details topic-form">

    <header class="topic-header">

      <?php $forum->snippet('user', array('user' => $forum->user())) ?>        

      <h1 class="delta">New Topic</h1>

      <div class="meta">
        <a href="<?php echo $forum->user()->url() ?>"><?php echo $forum->user()->username() ?></a>
        <small>/</small>
        <time class="added">Right now…</time>
      </div>

    </header>

    <div class="column four">
      <?php echo $forum->form('topic') ?>
    </div>

    <aside class="sidebar column two last">

      <h1 class="is-invisible">Topic navigation</h1>

      <ul>
        <li><a href="<?php echo $thread->url() ?>"><small>↑</small>Back to the thread</a></li>
      </ul>

      <?php $forum->snippet('guidelines') ?>        

    </aside>

  </section>

</section>