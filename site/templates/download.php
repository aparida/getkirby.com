<?php snippet('header') ?>

<section class="main columns download-single">

  <article class="column four">
    <header>
      <h1 class="alpha"><?php echo $page->title ?></h1>
      <p class="gamma subtitle"><?php echo $page->subtitle ?></p>
    </header>
    <div class="text">
      <?php echo kirbytext($page->install) ?>
      <p>Check out the <a href="<?php echo $page->docs ?>">full documentation</a> to learn more!
    </div>
  </article>

  <aside class="column two last download-meta">
    <h2 class="gamma">Learn more!</h2>
    <ul>
      <li><a href="<?php echo $page->link ?>">Download</a></li>
      <li><a href="<?php echo $page->docs ?>">Documentation</a></li>
      <?php if($page->tutorial != ''): ?>
      <li><a href="<?php echo $page->tutorial ?>">Tutorial</a></li>
      <?php endif ?>
    </ul>
    <div class="text">
      <?php echo kirbytext($page->description) ?>
    </div>
    <?php if($page->author != ''): ?>
    <small>Made by <a href="<?php echo $page->author_url ?>"><?php echo $page->author ?></a><?php if($page->twitter != ''): ?> | <a href="http://twitter.com/<?php echo $page->twitter ?>"><?php echo $page->twitter ?></a><?php endif ?></small>
    <?php endif ?>
  </aside>

</section>

<?php snippet('footer') ?>