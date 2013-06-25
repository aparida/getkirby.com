<?php snippet('header') ?>

<article class="main columns">
  
  <header>
    <h1 class="alpha"><?php echo widont(kirbytext($page->title(), false)) ?></h1>  

    <time class="article-date" datetime="<?php echo $page->date('c') ?>">
      <span class="month"><?php echo $page->date('M d') ?></span>
      <span class="year"><?php echo $page->date('Y') ?></span>
    </time>
  </header>
  
  <div class="body text column four">

    <?php echo str_replace('(\\', '(', kirbytext($page->text())) ?>

    <?php if(!c::get('local')): ?>
    <?php snippet('disqus', array('disqus_shortname' => 'getkirby', 'disqus_developer' => false)) ?>
    <?php endif ?>

  </div>      

  <aside class="sidebar column two last">

    <h1 class="is-invisible">Article navigation</h1>

    <ul>
      <li><a href="<?php echo $pages->find('blog')->url() ?>"><small>↑</small>Back to the article overview</a></li>

      <?php if($prev = $page->prevVisible()): ?>
      <li><a href="<?php echo $prev->url() ?>"><small>&rarr;</small> <?php echo html($prev->title()) ?></a></li>
      <?php endif ?>

      <?php if($next = $page->nextVisible()): ?>
      <li><a href="<?php echo $next->url() ?>"><small>&larr;</small> <?php echo html($next->title()) ?></a></li>
      <?php endif ?>
    </ul>

  </aside>

</article>

<?php snippet('footer') ?>