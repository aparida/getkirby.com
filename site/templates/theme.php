<?php snippet('header') ?>

<section class="main columns download-single theme">

  <article class="column four">
    <h1 class="alpha"><?php echo $page->title ?></h1>
    <p class="gamma subtitle"><?php echo $page->subtitle ?></p>

    <?php $image = $page->images()->first() ?>
    <figure><a href="http://<?php echo $page->link ?>"><img src="<?php echo $image->url() ?>" alt="Screenshot <?php echo $page->title ?> Theme" /></a></figure>
  </article>

  <aside class="column two last download-meta">
    <h2 class="gamma"><a href="http://<?php echo $page->link ?>"><?php echo $page->link ?></a></h2>
    <ul>
      <li><a href="<?php echo $page->download ?>">Download</a></li>
      <li><a href="<?php echo $page->docs ?>">Documentation</a></li>
    </ul>
    <?php echo kirbytext($page->description) ?>
    <?php if($page->author != ''): ?>
    <small>Made by <a href="<?php echo $page->author_url ?>"><?php echo $page->author ?></a><?php if($page->twitter != ''): ?> | <a href="http://twitter.com/<?php echo $page->twitter ?>"><?php echo $page->twitter ?></a><?php endif ?></small>
    <?php endif ?>
  </aside>

</section>

<?php snippet('footer') ?>