<?php snippet('header') ?>

<section class="main">

  <h1 class="is-invisible"><?php echo $page->title() ?></h1>

  <article class="introduction section text intro">

    <h1 class="alpha"><?php echo html($page->headline()) ?></h1>
    <h2 class="beta"><?php echo html($page->subheadline()) ?></h2>

    <?php echo kirbytext($page->intro()) ?>

  </article>

  <section class="features section columns">

    <h1 class="beta">Features</h1>

    <?php $count = 1; foreach($pages->find('features')->children() as $feature): ?>

    <article class="column two<?php e($count++%3==0, ' last') ?>">
      <h1 class="gamma"><?php echo html($feature->title()) ?></h1>
      <p class="text">
        <?php echo kirbytext($feature->text(), false) ?>
        <?php if($feature->link() != ''): ?>
        <a class="more" href="<?php echo $feature->link() ?>">Read more…</a>
        <?php endif ?>
      </p>
    </article>

    <?php e(($count-1)%3==0, '<hr class="c" />') ?>
    <?php endforeach ?>

  </section>

  <section class="references section columns">

    <h1 class="beta"><a href="<?php echo url('references/made-with-kirby-and-love') ?>">Made with Kirby and <strong>&#9829;</strong></a></h1>

    <?php $count = 1; foreach(page('references/made-with-kirby-and-love')->children()->shuffle()->limit(3) as $reference): ?> 
    <article class="reference column two<?php e($count++%3==0, ' last') ?>">
      
      <figure>            
        <a href="<?php echo $reference->link() ?>"><img src="<?php echo $reference->images()->first()->url() ?>" /></a>
      </figure>

      <h1 class="gamma"><a href="<?php echo $reference->link() ?>"><?php echo html($reference->title()) ?></a></h1>
      <h2 class="delta"><a href="<?php echo $reference->link() ?>"><?php echo url::short($reference->link()) ?></a></h2>
        
    </article>
    <?php endforeach ?>

  </section>

  <section class="voices section columns last">

    <h1 class="beta"><a href="<?php echo url('references/voices') ?>">What others say about Kirby</a></h1>

    <?php $count = 1; foreach(page('references/voices')->children()->visible()->shuffle()->limit(4) as $voice): ?>
    <article class="voice column three<?php e($count++%2==0, ' last') ?>">

      <figure>
        <a href="http://twitter.com/<?php echo $voice->username() ?>"><img src="http://twitter.com/api/users/profile_image/<?php echo $voice->username() ?>" /></a>
      </figure>

      <h1 class="gamma"><?php echo twitter($voice->username(), $voice->title()) ?></h1>
      <h2 class="delta"><?php echo twitter($voice->username()) ?></h2>

      <blockquote>
        <?php echo kirbytext($voice->text()) ?>
      </blockquote>

    </article>

    <?php e(($count-1)%2==0, '<hr class="c" />') ?>
    <?php endforeach ?>
    
  </section>

</section>

<?php snippet('footer') ?>