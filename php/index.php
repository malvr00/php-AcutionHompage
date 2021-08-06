<?php
  try{
    include_once __DIR__ .'/../includes/DbConnect.php'; // db 연결
    include_once __DIR__ .'/../includes/userInformation.php';   // 로그인 유저정보
    
    $title = Auction;

 // home 출력
  //ob_start();
    $outString = 'mainpage2';
  
  }catch(PDOException $e){
  // 임시
    $outString='<p>Error : ' . $e->getMessage(). $e->getFile(). ' Line : ' . $e->getLine() .'</p>';
  }
  
  include __DIR__ .'/../templates/layout.html.php';