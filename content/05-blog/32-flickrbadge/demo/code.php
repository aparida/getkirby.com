<?php require('flickrbadge.php') ?>

<?php 

$pictures = flickrbadge(array(
  'key'      => '45cd7efcbb55fdc18c74d3e9238c99ee',
  'username' => 'andreasdantz',
  'limit'    => 6,
  'format'   => 'small'
));
    
?>

<ul class="flickrbadge"">
  <?php foreach($pictures as $picture): ?>
  <li>
    <a class="thumb" href="<?php echo $picture->url() ?>"><img src="<?php echo $picture->src() ?>" alt="<?php echo $picture->title() ?>" /></a>
    <h3><a href="<?php echo $picture->url() ?>"><?php echo $picture->title() ?></a></h3>
    <div class="date"><?php echo date('d.m.Y - H:i', $picture->taken()) ?></div>
  </li>    
  <?php endforeach ?>
</ul>

