<?php
  $pdo = new PDO('mysql:host=localhost; dbname=auctiondb; charset=utf8', 'sejong', 'sj4321');
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);