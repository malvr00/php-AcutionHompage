<?php
  try{
    include_once __DIR__ .'/../includes/DbConnect.php';         // db 연결
    include_once __DIR__ .'/../includes/userInformation.php';   // 로그인 유저정보
    include_once __DIR__ .'/../includes/Userfunction.php';      // SQL Class
    
    $userId = $_GET['?id'];                   // user Id
    $auctionId = $_GET['auction'];            // auction id
    $usersFunction = new Userfunction($pdo);  // SQL Class 생성
    
  // SQL Query Select ( 클릭한 물품 Seach )  
    $sql = 'SELECT * FROM `article` WHERE `article_id` = ' . $auctionId;
    $result = $usersFunction->seachQurey($sql);

    ob_start();
    include __DIR__ .'/../templates/auctiondetail.html.php';
    $outString = ob_get_clean();
    
  }catch(PDOException $e){
    $outString='<p>Error : ' . $e->getMessage(). $e->getFile(). ' Line : ' . $e->getLine() .'</p>';
  }
  include __DIR__ .'/../templates/layout.html.php';