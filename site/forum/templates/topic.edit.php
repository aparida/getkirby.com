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
      <?php $forum->snippet('user', array('user' => $topic->user())) ?>        
      <h1 class="delta">Edit Topic: <a href="<?php echo $topic->url() ?>"><?php echo html($topic->title()) ?></a></h1>
      <?php $forum->snippet('topic.meta', array('topic' => $topic)) ?>        
    </header>

    <div class="column four">
      <?php echo $forum->form('topic') ?>
    </div>

    <aside class="sidebar column two last">

      <h1 class="is-invisible">Topic navigation</h1>

      <ul>
        <li><a href="<?php echo $topic->url() ?>"><small>↑</small>Back to the topic page</a></li>
        <li><a href="<?php echo $topic->url() ?>"><small>#</small>Topic direct link</a></li>
      </ul>      

      <?php $forum->snippet('guidelines') ?>        

    </aside>

  </section>

</section>