<nav class="menu clear" role="navigation">
  <h1 class="is-invisible">Main Menu</h1>

  <ul class="left menu-items">

    <?php foreach($pages->visible() as $item): ?>
    <?php $dropdown = ($item->hasVisibleChildren() and $item->uid() != 'blog' and $item->uid() != 'download') ? true : false ?>

    <li class="menu-item <?php e($dropdown, ' has-dropdown') ?><?php e($item->isOpen(), ' is-active') ?>">
      <a href="<?php echo $item->url() ?>"><?php echo html($item->title()) ?></a>
    
      <?php if($dropdown): ?>
      <ul class="dropdown">
        <?php foreach($item->children()->visible() as $item): ?>
        <li class="dropdown-item"><a href="<?php echo $item->url() ?>"><?php echo html($item->title()) ?></a></li>
        <?php endforeach ?>
      </ul>
      <?php endif ?>

    </li>
    <?php endforeach ?>
  </ul>

  <ul class="right menu-items">
    <li class="menu-item is-hidden-on-mobile"><a title="Download and test Kirby on your local machine as long as you want." href="<?php echo url('try') ?>">Try</a></li>
    <li class="menu-item is-hidden-on-mobile"><a title="Build an awesome website with Kirby!" class="love" href="<?php echo url('made-with-kirby-and-love') ?>">&#9829;</a></li>
    <li class="menu-item"><a title="Buy a Kirby license for just $39" href="<?php echo url('buy') ?>">Buy</a></li>
  </ul>

</nav>