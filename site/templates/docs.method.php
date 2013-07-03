<?php snippet('header') ?>

<div class="columns">

  <?php snippet('submenu') ?>

  <div class="column four last">

    <?php snippet('breadcrumb') ?>

      <article class="text">  

        <h1 class="with-selector">
          <?php snippet('methodhead') ?>()
          <?php snippet('selector') ?>
        </h1>  

        <div class="intro">
          <p><?php echo html($page->description()) ?></p>
          <?php $text = preg_replace('!<pre>(.*?)</pre>!is', '', (string)$page->text()) ?>
          <?php if(!empty($text)): ?>
          <p><?php echo html($text) ?></p>
          <?php endif ?>
        </div>

        <h2>Syntax</h2>
        <figure class="code">
          <pre class="highlight php"><?php echo highlight($page->syntax(), 'php') ?></pre>
        </figure>

        <?php 

        preg_match('!(<pre><code>.*?</code></pre>)!is', (string)$page->text(), $code);

        $code = @$code[0];
        $code = str_replace('<pre><code>', '```php', $code);
        $code = str_replace('</code></pre>', '```', $code);

        ?>

        <?php if(!empty($code)): ?>
        <h2>Example</h2>
        <?php echo kirbytext($code) ?>
        <?php endif ?>

        <?php if($params = yaml($page->parameters())): ?>
        <h2>Parameters</h2>
        
        <ul class="params">
          <?php foreach($params as $param): ?>
          <li>
            <small>(<?php echo $param['type'] ?>)</small> <strong><?php echo $param['name'] ?></strong>
            <em><?php echo html($param['text']) ?></em>
          </li>
          <?php endforeach ?>
        </ul>

        <?php endif ?>

        <?php if($page->returntype() != ''): ?>
        <h2>Return</h2>

        <ul class="params">
          <li>
            <small>(<?php echo $page->returntype() ?>)</small> 
            <strong><?php echo html($page->return()) ?></strong>
          </li>
        </ul>
        <?php endif ?>

        <?php snippet('githublink') ?>

        <nav class="jumper clear">
          <?php if($prev = $page->prevVisible()) echo html::a($prev->url(), '<i>&larr;</i> ' . $prev->title() . '()', array('class' => 'prev')) ?> 
          <?php if($next = $page->nextVisible()) echo html::a($next->url(), $next->title() . '() <i>&rarr;</i>', array('class' => 'next')) ?>
        </nav>

      </article>
  
  </div>

</div>

<?php snippet('footer') ?>