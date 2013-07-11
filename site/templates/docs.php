<?php snippet('header') ?>

<div class="columns">

  <?php snippet('submenu') ?>

  <div class="column four last">

    <?php snippet('breadcrumb') ?>

    <article class="text">
      <h1><?php echo html($page->title()) ?></h1>
      <?php echo str_replace('(\\', '(', kirbytext($page->text())) ?>

      <?php if($page->blogposts() or $page->forumposts() or $page->docs() or $page->externals()): ?>
      <footer class="further-reading">
        <h2 class="beta">Further reading</h2>

        <?php if($page->blogposts()): ?>
        <h3 class="gamma">Blogposts</h3>
        <ul>
            <?php $blogposts = yaml($page->blogposts()) ?>
            <?php foreach($blogposts as $blogpost): ?>
            <li><a href="<?php echo $blogpost['link'] ?>"><?php echo $blogpost['text'] ?></a></li>
            <?php endforeach ?>
        </ul>
        <?php endif ?>

        <?php if($page->forumposts()): ?>
        <h3 class="gamma">Forumposts</h3>
        <ul>
            <?php $forumposts = yaml($page->forumposts()) ?>
            <?php foreach($forumposts as $forumpost): ?>
            <li><a href="<?php echo $forumpost['link'] ?>"><?php echo $forumpost['text'] ?></a></li>
            <?php endforeach ?>
        </ul>
        <?php endif ?>

        <?php if($page->docs()): ?>
        <h3 class="gamma">Docs</h3>
        <ul>
            <?php $docs = yaml($page->docs()) ?>
            <?php foreach($docs as $doc): ?>
            <li><a href="<?php echo $doc['link'] ?>"><?php echo $doc['text'] ?></a></li>
            <?php endforeach ?>
        </ul>
        <?php endif ?>

        <?php if($page->externals()): ?>
        <h3 class="gamma">Other</h3>
        <ul>
            <?php $externals = yaml($page->externals()) ?>
            <?php foreach($externals as $external): ?>
            <li><a href="<?php echo $external['link'] ?>"><?php echo $external['text'] ?></a></li>
            <?php endforeach ?>
        </ul>
        <?php endif ?>
      </footer>
      <?php endif ?>
    </article>

  </div>

</div>

<?php snippet('footer') ?>