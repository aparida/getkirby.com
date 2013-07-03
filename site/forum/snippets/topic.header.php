<header class="topic-header<?php e($topic->solved(), ' is-solved') ?>">

  <?php $forum->snippet('user', array('user' => $topic->user())) ?>

  <h1 class="delta"><a href="<?php echo $topic->url() ?>"><?php echo html($topic->title()) ?></a></h1>

  <?php $forum->snippet('topic.meta', array('topic' => $topic)) ?>

  <?php if(isset($count) && $count): ?>
  <figure class="count">
    <a href="<?php echo $topic->url() ?>"><?php echo $topic->posts()->count() ?> Replies</a>
  </figure>
  <?php endif ?>

</header>