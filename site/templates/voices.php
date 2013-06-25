<?php snippet('header') ?>

<section class="main columns">

  <h1 class="alpha"><?php echo html($page->title()) ?></h1>

  <?php $count = 1; foreach($page->children() as $voice): ?>
  <article class="voice column three<?php e($count++%2==0, ' last') ?>">

    <figure>
      <a href="http://twitter.com/<?php echo $voice->username() ?>"><img src="http://twitter.com/api/users/profile_image/<?php echo $voice->username() ?>" /></a>
    </figure>

    <h1 class="gamma"><?php echo twitter($voice->username(), $voice->title()) ?></h1>
    <h2 class="delta"><?php echo twitter($voice->username()) ?></h2>

    <blockquote>
      <?php echo kirbytext($voice->text()) ?>
    </blockquote>

  </article>
  <?php endforeach ?>

</section>

<?php snippet('footer') ?>