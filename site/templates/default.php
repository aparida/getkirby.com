<?php snippet('header') ?>

<article class="main text">

  <h1><?php echo kirbytext($page->title(), false) ?></h1>
  <?php echo kirbytext($page->text()) ?>

</article>

<?php snippet('footer') ?>
