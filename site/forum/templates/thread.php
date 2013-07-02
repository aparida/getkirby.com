<section class="main forum">

  <header class="forum-header">

    <h1>
      <a class="alpha" href="<?php echo $forum->url() ?>">Forum</a> <small>/</small>
      <a class="alpha is-active" href="<?php echo $thread->url() ?>"><?php echo html($thread->title()) ?></a>
    </h1>

    <?php echo $forum->menu() ?>

  </header>

  <?php foreach($topics = $thread->topics()->page(param('page'), 20) as $topic): ?>
  <article class="topic">

    <?php $forum->snippet('topic.header', array('topic' => $topic, 'count' => true)) ?>

  </article>
  <?php endforeach ?>

  <?php $forum->snippet('pagination', array('pagination' => $topics->pagination())) ?>

</section>