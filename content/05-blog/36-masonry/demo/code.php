<div id="container">
  <ul>
    <?php foreach($page->children()->find('pics')->images()->shuffle() as $pic): ?>
    <li>
      <?php $pic->fitWidth(200) ?>
      <a href="<?php echo $pic->link() ?>"><img src="<?php echo $pic->url() ?>" height="<?php echo $pic->height() ?>" /></a>
    </li>
    <?php endforeach ?>
  </ul>
</div>


