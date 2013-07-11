<?php

// load the header snippet and add the feed
snippet('header', array(
  'feeds' => array(
    $blog->feedurl() => 'Kirby Blog'
  )
));

?>
<section class="main articles">

  <h1 class="is-invisible">Blog</h1>

  <?php foreach($blog->articles() as $article): ?>
  <article class="article-preview">
    
    <h1 class="alpha"><a href="<?php echo $article->url() ?>"><?php echo widont(kirbytext($article->title(), false)) ?></a></h1>  
    <time class="article-date" datetime="<?php echo $page->date('c') ?>">
      <span class="month"><?php echo $article->date('M d') ?></span>
      <span class="year"><?php echo $article->date('Y') ?></span>
    </time>
    
  </article>
  <?php endforeach ?>

  <?php echo $blog->pagination() ?>

</section>

<?php snippet('footer') ?>