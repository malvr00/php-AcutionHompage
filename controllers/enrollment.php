<?php
  ob_start();
  include __DIR__ .'/../templates/enrollment.html.php';
  $outString = ob_get_clean();
  include __DIR__ .'/../templates/layout.html.php';