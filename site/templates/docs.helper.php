<?php snippet('header') ?>

<div class="columns">

  <?php snippet('submenu') ?>

  <div class="column four last">

    <?php snippet('breadcrumb') ?>

    <article class="text">
      <h1><?php echo html($page->title()) ?></h1>
      <?php echo str_replace('(\\', '(', kirbytext($page->text())) ?>
    </article>

  </div>

</div>

<?php snippet('footer') ?>