<section class="main forum">

  <header class="forum-header">
    <h1>
      <a class="alpha" href="<?php echo $forum->url() ?>">Forum</a> <small>/</small>
      <a class="alpha is-active" href="<?php echo $forum->url('search') ?>">Search</a>
    </h1>

    <?php echo $forum->menu() ?>

  </header>

  <?php echo $forum->form('search') ?>

  <ul>
    <?php foreach($forum->search()->results() as $result): ?>
    <li>


    </li>
    <?php endforeach ?>
  </ul>

</section>