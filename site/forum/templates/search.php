<section class="main forum">

  <header class="forum-header">
    <h1>
      <a class="alpha" href="<?php echo $forum->url() ?>">Forum</a> <small>/</small>
      <a class="alpha is-active" href="<?php echo $forum->url('search') ?>">Search</a>
    </h1>

    <?php echo $forum->menu() ?>

  </header>

  <div class="search-form">

    <?php echo $forum->form('search') ?>

    <?php if($forum->search()->topics()->count()): ?>
    <section class="search-results topics">

      <header class="search-results-header">
        <h1 class="gamma">Topics (<?php echo $forum->search()->topics()->count() ?>)</h1>
      </header>

      <?php foreach($forum->search()->topics() as $topic): ?>
      <article class="topic">

        <header class="topic-header">

          <figure class="user">
            <a href="<?php echo $topic->user()->url() ?>"><img src="<?php echo $topic->user()->avatar() ?>" /></a>
          </figure>

          <h1 class="delta">
            <a href="<?php echo $topic->url() ?>"><?php echo html($topic->title()) ?></a>
          </h1>

          <div class="meta">

            Thread: <a href="<?php echo $topic->thread()->url() ?>"><?php echo html($topic->thread()->title()) ?></a> 
            <small>/</small>            
            User: <a href="<?php echo $topic->user()->url() ?>"><?php echo html($topic->user()->username()) ?></a> 
            <small>/</small>            
            <time class="added"><?php echo date('d.m.Y – H:i', $topic->added()) ?></time>
          
          </div>

        </header>

        <div class="text">
          <p><?php echo excerpt($topic->text(), 200) ?></p>
        </div>

      </article>
      <?php endforeach ?>
    </section>

    <?php endif ?>

    <?php if($forum->search()->posts()->count()): ?>
    <section class="search-results posts">

      <header class="search-results-header">
        <h1 class="gamma">Posts (<?php echo $forum->search()->posts()->count() ?>)</h1>
      </header>

      <?php foreach($forum->search()->posts() as $post): ?>
      <article class="post">

        <header class="post-header">

          <figure class="user">
            <a href="<?php echo $post->user()->url() ?>"><img src="<?php echo $post->user()->avatar() ?>" /></a>
          </figure>

          <h1 class="delta">
            <a href="<?php echo $post->url() ?>"><small>Reply by</small> <?php echo $post->user()->username() ?></a>
          </h1>

          <div class="meta">
            Thread: <a href="<?php echo $post->topic()->thread()->url() ?>"><?php echo html($post->topic()->thread()->title()) ?></a> 
            <small>/</small>
            Topic: <a href="<?php echo $post->topic()->url() ?>"><?php echo html($post->topic()->title()) ?></a> 
            <small>/</small>
            <time class="added"><?php echo date('d.m.Y – H:i', $topic->added()) ?></time>
          </div>

        </header>

        <div class="text">
          <p><?php echo excerpt($topic->text(), 200  ) ?></p>
        </div>

      </article>
      <?php endforeach ?>
    </section>
    <?php endif ?>

  </div>

</section>