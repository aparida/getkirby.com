<?php snippet('header') ?>

<article class="main columns">

  <h1 class="alpha">Imprint</h1>

  <section class="column three text">
    <h1 class="beta">Contact & Responsibility</h2>
    <?php echo kirbytext($page->contact()) ?>
  </section>

  <section class="column three last text">
    <h1 class="beta">Disclaimer</h2>
    <?php echo kirbytext($page->disclaimer()) ?>
  </section>

</article>

<?php snippet('footer') ?>