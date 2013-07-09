<?php snippet('header') ?>

<div class="columns">

  <?php snippet('submenu') ?>

  <div class="column four last">

    <?php snippet('breadcrumb') ?>

    <article class="text">
      <h1><?php echo html($page->title()) ?></h1>
      <?php echo str_replace('(\\', '(', kirbytext($page->text())) ?>

      <footer class="further-reading">
        <h1 class="beta">Further reading</h1>
        <?php if($page->blogposts() != ""): ?>
        <h2 class="gamma">Blogposts</h2>
        <ul>
            <?php $blogposts = yaml($page->blogposts()) ?>
            <?php foreach($blogposts as $key => $blogpost): ?>
            <li><a href="<?php echo $article['link'] ?>"><?php echo $key ?></a></li>
            <?php endforeach ?>
        </ul>
        <?php endif ?>

        <?php if($page->forumposts() != ""): ?>
        <h2 class="gamma">Forumposts</h2>
        <ul>
            <?php $forumposts = yaml($page->forumposts()) ?>
            <?php foreach($forumposts as $key => $forumpost): ?>
            <li><a href="<?php echo $forumpost['link'] ?>"><?php echo $key ?></a></li>
            <?php endforeach ?>
        </ul>
        <?php endif ?>

        <?php if($page->forumposts() != ""): ?>
        <h2 class="gamma">Docs</h2>
        <ul>
            <?php $docs = yaml($page->docs()) ?>
            <?php foreach($docs as $key => $doc): ?>
            <li><a href="<?php echo $doc['link'] ?>"><?php echo $key ?></a></li>
            <?php endforeach ?>
        </ul>
        <?php endif ?>

        <?php if($page->others() != ""): ?>
        <h2 class="gamma">Other</h2>
        <ul>
            <?php $others = yaml($page->others()) ?>
            <?php foreach($others as $key => $other): ?>
            <li><a href="<?php echo $other['link'] ?>"><?php echo $key ?></a></li>
            <?php endforeach ?>
        </ul>
        <?php endif ?>
      </footer>
    </article>

  </div>

</div>

<?php snippet('footer') ?>