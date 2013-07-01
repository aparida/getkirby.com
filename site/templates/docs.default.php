<?php snippet('header') ?>

<div class="columns">

  <?php snippet('submenu') ?>

  <div class="column four last">

    <?php snippet('breadcrumb') ?>

    <article class="text">
      
      <h1><?php echo html($page->title()) ?></h1>
      <div class="intro"><p><?php echo html($page->description()) ?></p></div>

      <h2>Default value</h2>
      <figure class="code">
        <?php echo kirbytext($page->value()) ?>
      </figure>

      <h2>Overwriting syntax</h2>

      <figure class="code">
        <?php echo kirbytext('```php
          c::set(\'' . $page->title() . '\', \'your value\');
        ```'); ?>
      </figure>

      <h2>Getter syntax</h2>

      <figure class="code">
        <?php echo kirbytext('```php
          c::get(\'' . $page->title() . '\');
        ```'); ?>
      </figure>

      <?php snippet('githublink') ?>

      <nav class="jumper clear">
        <?php if($prev = $page->prevVisible()) echo html::a($prev->url(), '<i>&larr;</i> ' . $prev->title(), array('class' => 'prev')) ?>
        <?php if($next = $page->nextVisible()) echo html::a($next->url(), $next->title() . ' <i>&rarr;</i>', array('class' => 'next')) ?>
      </nav>

    </article>

  </div>

</div>

<?php snippet('footer') ?>