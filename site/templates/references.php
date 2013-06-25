<?php snippet('header') ?>

<section class="main columns">

  <h1 class="alpha">Made with Kirby and <strong>&#9829;</strong></h1>
    
  <?php $count = 1; foreach($page->children()->flip() as $reference): ?> 
  <article class="reference column two<?php e($count++%3==0, ' last') ?>">
     
    <figure>           
      <a href="<?php echo $reference->link() ?>"><img src="<?php echo $reference->images()->first()->url() ?>" /></a>
    </figure>

    <h1 class="gamma"><a href="<?php echo $reference->link() ?>"><?php echo html($reference->title()) ?></a></h1>
    <h2 class="delta"><a href="<?php echo $reference->link() ?>"><?php echo url::short($reference->link()) ?></a></h2>
    
  </article>

  <?php e(($count-1)%3==0, '<hr />') ?>

  <?php endforeach ?>
      
</section>

<?php snippet('footer') ?>