<?php snippet('header') ?>

<div class="main columns">

  <article class="column three text">
    <h1 class="alpha">Contact me</h1>
    <?php echo kirbytext($page->text()) ?>
  </article>

  <article class="column three last text">
    <h1 class="alpha">Follow Kirby</h1>
    <?php echo kirbytext($page->web()) ?>
  </article>

</div>

<?php snippet('footer') ?>