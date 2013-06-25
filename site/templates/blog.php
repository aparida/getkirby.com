<?php

// get the current tag
$tag = urldecode(param('tag'));

// get all visible articles
$articles = $page->children()->visible();

// filter the articles by tags
if($tag) $articles = $articles->filterBy('tags', $tag, ',');

// sort the articles and paginate them
$articles = $articles->sortBy('date', 'desc')->paginate(20);

// load the header snippet and add the feed
snippet('header', array(
  'feeds' => array(
    'blog/feed' => 'Kirby Blog'
  )
));

?>

<section class="main articles">

  <h1 class="is-invisible">Blog</h1>

  <?php foreach($articles as $article): ?>
  <article class="article-preview">
    
    <h1 class="alpha"><a href="<?php echo $article->url() ?>"><?php echo widont(kirbytext($article->title(), false)) ?></a></h1>  
    <time class="article-date" datetime="<?php echo $page->date('c') ?>">
      <span class="month"><?php echo $article->date('M d') ?></span>
      <span class="year"><?php echo $article->date('Y') ?></span>
    </time>
    
  </article>
  <?php endforeach ?>

  <?php if($articles->pagination()->hasPages()): ?>
  <nav class="pagination" role="navigation">  
    <?php if($articles->pagination()->hasNextPage()): ?>
    <a class="next" href="<?php echo $articles->pagination()->nextPageURL() ?>">&lsaquo; older posts</a>
    <?php endif ?>

    <?php if($articles->pagination()->hasPrevPage()): ?>
    <a class="prev" href="<?php echo $articles->pagination()->prevPageURL() ?>">newer posts &rsaquo;</a>
    <?php endif ?>
  </nav>
  <?php endif ?>

</section>

<?php snippet('footer') ?>