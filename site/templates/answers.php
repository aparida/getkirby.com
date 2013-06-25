<?php snippet('header') ?>

<div class="main columns">

  <section class="answers column four">  
    
    <h1 class="alpha">Answers</h1>

    <?php foreach($page->children() as $answer): ?>
    <article class="answer">
      <h1 class="delta"><a href=""><?= html($answer->title()) ?></a></h1>
      <div class="inner text is-invisible">
        <?php echo kirbytext($answer->text()) ?>      
      </div>
    </article>
    <?php endforeach ?>

  </section>

  <article class="column two last questions text">
    <h1 class="alpha">Questions?</h1>
    <div class="body">
      <?php echo kirbytext($page->questions()) ?>
    </div>
  </article>

</div>

<?php snippet('footer') ?>