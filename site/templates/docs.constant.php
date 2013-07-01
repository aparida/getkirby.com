<?php snippet('header') ?>

<div class="columns">

  <?php snippet('submenu') ?>

  <div class="column four last">

    <?php snippet('breadcrumb') ?>

    <article class="text">  

      <h1 class="with-selector">
        Constant
        <?php snippet('selector') ?>
      </h1>
      
      <figure class="code">
        <pre><code><?php echo html($page->title()) ?></pre></code>
      </figure>

      <div class="intro">
      <?php echo kirbytext($page->description()) ?>
      </div>

      <?php snippet('githublink') ?>

      <nav class="jumper clear">
        <?php if($prev = $page->prevVisible()) echo html::a($prev->url(), '<i>&larr;</i> ' . $prev->title(), array('class' => 'prev')) ?>
        <?php if($next = $page->nextVisible()) echo html::a($next->url(), $next->title() . ' <i>&rarr;</i>', array('class' => 'next')) ?>
      </nav>

    </article>
  </div>

</div>

<?php snippet('footer') ?>