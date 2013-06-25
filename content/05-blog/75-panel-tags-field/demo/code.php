<?php

$data  = array();
$store = array();
$store = $pages->find('blog')->children()->visible();
$field = 'tags';

// get all tags
foreach($store as $s) {
  $data = array_merge($data, str::split($s->{$field}));
}

// make sure we get a nice array
$data = array_values(array_unique($data));
sort($data);

?>
<input type="text" id="tags" class="input" name="tags" value="" />

<p>
  Enter new tags and confirm them with <code>tab</code>, <code>enter</code> or <code>,</code>
  Remove tags with <code>backspace</code>
</p>
<p>
  You can try to type in one of the following tags. <br />They are fetched from the Kirby blog:    
</p>
<p>
  <code>
  <?php echo implode(', ', $data) ?>
  </code>
</p>

<script type="text/javascript">
$(function() {
  $('#tags').tagbox({
    url : <?php echo json_encode((array)$data) ?>, 
    lowercase : true
  });
});
</script>