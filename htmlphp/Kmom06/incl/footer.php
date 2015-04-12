<?php
include('static.php');
?>

<!--- Footer -->
<div id="footer">
<hr>
<footer id="bottom">
  <p>Verktyg:
    <?php echo tools(); ?>
  </p>

  <p>Manualer:
    <?php echo manual(); ?>
  </p>

  <p>
    <?php echo pageTime($pageTimeGeneration); ?>
  </p>

</footer>
</div>
</body>
</html>
