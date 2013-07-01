<nav class="forum-menu" role="navigation">

  <h1 class="is-invisible">Forum Navigation</h1>

  <?php if($user): ?>

  <figure class="user">
    <a href="<?php echo $user->url() ?>"><img src="<?php echo $user->avatar() ?>" /></a>
  </figure>

  <ul>
    <li><a href="<?php echo $user->url() ?>"><?php echo html($user->username()) ?></a></li>

    <?php if($thread): ?>
    <li><a href="<?php echo $thread->url() ?>/topic">New Topic</a></li>
    <?php endif ?>    

    <li><a href="<?php echo $forum->url('search') ?>">Search</a></li>
    <li><a href="<?php echo $forum->url('logout') ?>">Logout</a></li>
  </ul>

  <?php else: ?>

  <ul>
    <li><a href="<?php echo $forum->url('search') ?>">Search</a></li>
    <li><a href="<?php echo $forum->url('login') ?>">Login via Twitter</a></li>
  </ul>

  <?php endif ?>

</nav>