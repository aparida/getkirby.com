<?php if($forum->user()): ?>
<section class="topic topic-form">

  <header class="topic-header">

    <figure class="user">
      <a href="<?php echo $forum->user()->url() ?>"><img src="<?php echo $forum->user()->avatar() ?>" /></a>
    </figure>

    <h1 class="delta">New Topic</h1>

    <div class="meta">
      <a href="<?php echo $forum->user()->url() ?>"><?php echo $forum->user()->username() ?></a> &rsaquo; 
      <time class="added">
        Right now…
      </time>
    </div>

  </header>

  <div class="column four">
    <?php echo $form ?>
  </div>

  <div class="column two last text">
    <strong>Read me:</strong>
    <p>Please, make sure that there's no such topic in the forum yet.</p>

    <p>Stick to some simple rules: <em>no spam, no porn, no violence</em>.</p>

    <p>Please, just post topics related to Kirby.</p>

    <strong>Text formats</strong>
    <p>You may use <a href="http://daringfireball.net/projects/markdown/">Markdown</a> and <a href="http://getkirby.com/docs/formatting-text">Kirbytext</a> to format your text</p>
  </div>

</section>
<?php endif ?>