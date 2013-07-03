<section class="main forum columns">

  <header class="forum-header">
    <h1>
      <a class="alpha" href="<?php echo $forum->url() ?>">Forum</a> <small>/</small>
      <a class="alpha" href="<?php echo $thread->url() ?>"><?php echo html($thread->title()) ?></a>
    </h1>

    <?php echo $forum->menu() ?>
  </header>

  <section class="post post-form">

    <?php $forum->snippet('post.header', array('post' => $post)) ?>        

    <div class="column four">
      <?php echo $forum->form('post') ?>
    </div>

    <aside class="sidebar column two last">

      <h1 class="is-invisible">Post navigation</h1>

      <ul>
        <li><a href="<?php echo $topic->url() ?>"><small>↑</small>Back to the topic</a></li>
        <li><a href="<?php echo $post->url() ?>"><small>#</small>Reply direct link</a></li>
      </ul>

    </aside>

  </section>

</section>