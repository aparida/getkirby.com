<?php snippet('header') ?>
<?php

$search = new search(array(
  'searchfield' => 'q',
  'ignore'      => array('betas', 'search', 'error'),
  'words'       => true,
  'paginate'    => 10,
));

$results = $search->results();

?>
<section class="main">

  <h1><?php echo html($page->title()) ?></h1>

  <form action="<?php echo $page->url() ?>">
    <input type="text" placeholder="Search the Kirby site…" name="q" value="<?php echo html($search->query()) ?>" />
    <input type="submit" value="Search" />
  </form>

  <?php if($results): ?>
  
  <?php snippet('searchpagination', array('pagination' => $results->pagination())) ?>
  
  <?php foreach($results as $row): ?>
  <article>
    <h1 class="delta"><a href="<?php echo $row->url() ?>"><?php echo html($row->title()) ?></a></h1>
    <a href="<?php echo $row->url() ?>"><?php echo html($row->url()) ?></a>
  </article>
  <?php endforeach ?>

  <?php snippet('searchpagination', array('pagination' => $results->pagination())) ?>
  
  <?php elseif($search->query()): ?>
  <div class="no-results">No results for <strong><?php echo html($search->query()) ?></strong></div>
  <?php endif ?>

</section>

<?php snippet('footer') ?>