
    <footer class="footer">
      <p class="copyright"><?php echo kirbytext($site->copyright(), false) ?></p>
      <p class="misc">
        <a href="<?php echo url('license') ?>">License</a> /
        <a href="<?php echo url('imprint') ?>">Imprint</a> / 
        <a class="made-with" href="<?php echo url('made-with-kirby-and-love') ?>">Made with Kirby and <em class="love">&#9829;</em></a>
      </p>      
    </footer>

  </div>

  <?php echo js('assets/js/jquery.js') ?>
  <?php echo js('@auto') ?>

</body>

</html>