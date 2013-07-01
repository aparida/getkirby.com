<?php if($forum->user()): ?>
<section class="post-form" id="reply">

  <header class="post-header">

    <figure class="user">
      <a href="<?php echo $forum->user()->url() ?>"><img src="<?php echo $forum->user()->avatar() ?>" /></a>
    </figure>

    <h1 class="delta">Your Reply</h1>

    <time class="added" datetime="<?php echo date('c') ?>">
      Right now…
    </time>

  </header>

  <?php echo $form ?>
    
</section>
<?php endif ?>