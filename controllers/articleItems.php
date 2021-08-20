<?php
  try{
    include_once __DIR__ .'/../includes/DbConnect.php';         // db 연결
    include_once __DIR__ .'/../includes/userInformation.php';   // 로그인 유저정보
    include_once __DIR__ .'/../includes/Userfunction.php';      // SQL Class
    
    $usersFunction = new Userfunction($pdo);                    // SQL Class 생성
    
  // ********** 등록된 물품 Seach ********** //
    $result = $usersFunction->seachQuery('SELECT * FROM `article`');
     
    ob_start();
    include __DIR__ .'/../templates/articleItems.html.php';
    $outString = ob_get_clean();
    
  }catch(PDOExcpetion $e){
    $outString='<p>Error : ' . $e->getMessage(). $e->getFile(). ' Line : ' . $e->getLine() .'</p>';
  }
  include __DIR__ .'/../templates/layout.html.php';