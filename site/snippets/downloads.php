<ul class="downloads">
  <?php $n=0; foreach(($section->uid() == 'themes') ? $section->children()->flip() : $section->children() as $download): $n++; ?>

  <?php if($section->uid() == 'themes'): ?>

  <li class="column theme half<?php if($n%2 == 0) echo ' last' ?>" id="<?php echo $key . '/' . $download->uid() ?>">
    <h3><a href="<?php echo $download->link() ?>"><?php echo html($download->title()) ?></a></h3>

    <div class="text"><?php echo kirbytext($download->text()) ?></div>

    <a href="<?php echo $download->link() ?>" class="image"><img src="<?php echo $download->images()->first()->url() ?>" alt="<?php echo html($download->title()) ?>" /></a>
    
    <ul>
      <li><a href="<?php echo $download->link() ?>">Demo</a></li>      
      <li><a href="<?php echo $download->download() ?>">Download</a></li>      

      <?php if($download->docs() != ''): ?>   
      <li class="docs"><a href="<?php echo $download->docs() ?>">Documentation</a></li>   
      <?php endif ?>

    </ul>
  </li>


  <?php else: ?>
  <li class="column half<?php if($n%2 == 0) echo ' last' ?>" id="<?php echo $key . '/' . $download->uid() ?>">
    <h3><a href="<?php echo $download->link() ?>"><?php echo html($download->title()) ?></a></h3>
    <a href="<?php echo $download->link() ?>" class="image"><img src="<?php echo $download->images()->first()->url() ?>" alt="<?php echo html($download->title()) ?>" /></a>

    <div class="text"><?php echo kirbytext($download->text()) ?></div>
    
    <ul>
      <li class="download"><a href="<?php echo $download->link() ?>">Download</a></li>      

      <?php if($download->docs() != ''): ?>   
      <li class="docs"><a href="<?php echo $download->docs() ?>">Documentation</a></li>   
      <?php else: ?>
      <li class="docs"><span>Documentation</span></li>
      <?php endif ?>

      <?php if($download->tutorial() != ''): ?>   
      <li class="tutorial"><a href="<?php echo $download->tutorial() ?>">Tutorial</a></li>      
      <?php else: ?>
      <li class="tutorial"><span>Tutorial</span></li>
      <?php endif ?>

    </ul>
  </li>
  <?php endif ?>
  
  <?php endforeach ?>
</ul>

