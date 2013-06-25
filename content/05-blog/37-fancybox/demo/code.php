<div id="gallery">
  <ul>
    <?php foreach($pages->find('made-with-kirby-and-love')->children() as $reference): ?>
    <li>
      <?php $img = $reference->images()->first() ?>
      <a title="<?php echo $reference->title() ?>" href="<?php echo $img->url() ?>" rel="gallery"><?php echo thumb($img, array('width' => 200)) ?></a>
    </li>
    <?php endforeach ?>
  </ul>
</div>