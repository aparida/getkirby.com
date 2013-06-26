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

  <?php snippet('pagination', array('pagination' => $articles->pagination())) ?>

</section>

<?php snippet('footer') ?>