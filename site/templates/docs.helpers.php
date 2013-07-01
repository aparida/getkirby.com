<?php snippet('header') ?>

<div class="columns">

  <?php snippet('submenu') ?>

  <div class="column four last">

    <?php snippet('breadcrumb') ?>

    <article class="text">  

      <h1><?php echo html($page->title()) ?></h1>
      
      <div class="intro">
      <?php echo kirbytext($page->description()) ?>
      </div>

      <?php echo kirbytext($page->text()) ?>

      <ul class="list columns">
        <?php $n=0; foreach($page->children() as $item): $n++; ?>
        <li class="column three<?php e($n%2 == 0, ' last') ?>"><a href="<?php echo $item->url() ?>"><?php echo html($item->title()) ?>()</a></h3></li>
        <?php endforeach ?>
      </ul>

      <?php snippet('githublink') ?>
      <?php snippet('jumper') ?>

    </article>

  </div>

</div>

<?php snippet('footer') ?>