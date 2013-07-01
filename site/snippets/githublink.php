<?php if($link = githublink()): ?>
<h2>File on Github</h2>
<ul class="list">
  <li><?php echo html::a($link) ?></li>
</ul>
<?php endif ?>
