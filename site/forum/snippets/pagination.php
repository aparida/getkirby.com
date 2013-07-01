<nav class="pagination" role="navigation">

  <h1 class="is-invisible">Pagination</h1>

  <ul>
    <?php if($pagination->hasPrevPage()): ?>
    <li class="prev"><a href="<?php echo $pagination->prevPageURL() ?>">&lsaquo; previous page</a></li>
    <?php else: ?>
    <li class="prev"><span>&lsaquo; previous page</span></li>
    <?php endif ?>


    <li class="count"><?php echo $pagination->numStart() ?> - <?php echo $pagination->numEnd() ?> of <?php echo $pagination->items() ?></li>

    <?php if($pagination->hasNextPage()): ?>
    <li class="next"><a href="<?php echo $pagination->nextPageURL() ?>">next page &rsaquo;</a></li>
    <?php else: ?>
    <li class="next"><span>next page &rsaquo;</span></li>
    <?php endif ?>
  </ul>

</nav>