<?php snippet('header') ?>

<div class="columns">

  <?php snippet('submenu') ?>

  <div class="column four last">

    <?php snippet('breadcrumb') ?>

    <article class="text">  

      <h1 class="with-selector">
        <?php echo html($page->title()) ?>
        <?php snippet('selector') ?>
      </h1>
      
      <div class="intro">
        <p><?php echo html($page->description()) ?></p>
        <?php if($page->text() != ''): ?><p><?php echo html($page->text()) ?></p><?php endif ?>
      </div>

      <h2>Methods</h2>

      <ul class="list columns">
        <?php $n=0; foreach($page->children()->find('methods')->children() as $method): $n++; ?>
        <li class="column three<?php e($n%2 == 0, ' last') ?>"><a href="<?php echo $method->url() ?>"><?php echo html($method->title()) ?>()</a></li>
        <?php endforeach ?>
      </ul>

      <?php if($subclasses = $page->children()->find('subclasses')): ?>
      <h2>Subclasses</h2>

      <ul class="list columns">
        <?php $n=0; foreach($subclasses->children() as $item): $n++; ?>
        <li class="column three<?php e($n%2 == 0, ' last') ?>"><a href="<?php echo $item->url() ?>"><?php echo html($item->title()) ?></a></h3></li>
        <?php endforeach ?>
      </ul>

      <?php endif ?>

      <?php snippet('githublink') ?>

    </article>

  </div>

</div>

<?php snippet('footer') ?>