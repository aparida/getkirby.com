<div id="carousel" class="carousel">

  <div class="carousel-inner">
    <?php $n=0; foreach($page->images() as $image): $n++; ?>
    <div class="item<?php if($n==1) echo ' active' ?>">
      <img src="<?php echo $image->url() ?>" alt="<?php echo $image->title() ?>" />
      <div class="carousel-caption">
        <?php echo kirbytext($image->caption()) ?>
      </div>
    </div>
    <?php endforeach ?>
  </div>

  <a class="carousel-control left" href="#carousel" data-slide="prev">&lsaquo;</a>
  <a class="carousel-control right" href="#carousel" data-slide="next">&rsaquo;</a>

</div>

<script>

$(function() {
  
  $('.carousel').carousel('pause');
    
});

</script>
