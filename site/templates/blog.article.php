<?php snippet('header') ?>

<article class="main columns">
  
  <header>
    <h1 class="alpha"><?php echo widont(kirbytext($article->title(), false)) ?></h1>  

    <time class="article-date" datetime="<?php echo $page->date('c') ?>">
      <span class="month"><?php echo $article->date('M d') ?></span>
      <span class="year"><?php echo $article->date('Y') ?></span>
    </time>
  </header>
  
  <div class="body text column four">

    <?php echo str_replace('(\\', '(', kirbytext($article->text())) ?>

    <?php if(!c::get('local')): ?>
    <?php snippet('disqus', array('disqus_shortname' => 'getkirby', 'disqus_developer' => false)) ?>
    <?php endif ?>

  </div>      

  <aside class="sidebar column two last">

    <h1 class="is-invisible">Article sidebar</h1>

    <nav>
      <h1 class="is-invisible">Navigation</h1>
      <ul>
        <li><a href="<?php echo $pages->find('blog')->url() ?>"><small>↑</small>Back to the article overview</a></li>

        <?php if($prev = $article->prevVisible()): ?>
        <li><a href="<?php echo $prev->url() ?>"><small>&rarr;</small> <?php echo html($prev->title()) ?></a></li>
        <?php endif ?>

        <?php if($next = $article->nextVisible()): ?>
        <li><a href="<?php echo $next->url() ?>"><small>&larr;</small> <?php echo html($next->title()) ?></a></li>
        <?php endif ?>
      </ul>
    </nav>

    <?php if($article->tags()->count()): ?>
    <nav class="tags">
      <h1 class="delta">Tags</h1>
      <ul>
        <?php foreach($article->tags() as $tag): ?>
        <li><a rel="tag" href="<?php echo $tag->url() ?>"><small>#</small><?php echo html($tag->name()) ?></a></li>
        <?php endforeach ?>
      </ul>
    </section>
    <?php endif ?>

  </aside>

</article>

<?php snippet('footer') ?>