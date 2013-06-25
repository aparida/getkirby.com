<?php 

$blog = $pages->find('blog');
$tags = tagcloud($blog, array(
  'limit' => 100
));

?>    

<div class="sidebar column two">

  <header>
    <h1 class="alpha"><a href="<?php echo $blog->url() ?>"><?php echo html($blog->title()) ?></a></h1>
    <h2 class="beta"><a href="<?php echo url('blog/feed') ?>">RSS</a></h2>
    <?php echo kirbytext($blog->text()) ?>
  </header>

  <nav class="tags clear" role="navigation">

    <h1 class="beta">Tags</h1>
    
    <ul>
      <?php foreach($tags as $tag): ?>
      <li><a<?php e($tag->isActive(), ' class="is-active"') ?> href="<?php echo $tag->url() ?>"><?php echo $tag->name() ?></a></li>
      <?php endforeach ?>
    </ul>
    
  </nav>

</div>