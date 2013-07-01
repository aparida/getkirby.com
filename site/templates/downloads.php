<?php snippet('header') ?>

<section class="main">

  <h1 class="alpha">Downloads</h1>

  <?php foreach($page->children() as $category): ?>

    <section class="section columns">  
      
      <h1 class="beta"><?php echo html($category->title()) ?></h1>

      <?php $count = 1; foreach($category->children() as $download): ?>
      <article class="download column three<?php e($count++%2==0, ' last') ?>">
        <figure class="icon">
          <a href="<?php echo $download->url() ?>"><img src="<?php echo $download->images()->first()->url() ?>" /></a>
        </figure>
        <h1 class="gamma"><a href="<?php echo $download->url() ?>"><?php echo html($download->title()) ?></a></h1>
      </article>
      <?php endforeach ?>

    </section>

  <?php endforeach ?>

</section>

<?php snippet('footer') ?>