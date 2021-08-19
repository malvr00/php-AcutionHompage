<?php
  try{
    include_once __DIR__ .'/../includes/DbConnect.php';         // db 연결
    include_once __DIR__ .'/../includes/userInformation.php';   // 로그인 유저정보
    include_once __DIR__ .'/../includes/Userfunction.php';      // SQL Class
    
    $check = htmlspecialchars($_POST['check'], ENT_QUOTES, 'UTF-8');  // 충전 버튼 Click 확인
    
    if(!empty($check)){
      $point = intval(htmlspecialchars($_POST['pay'], ENT_QUOTES, 'UTF-8'));  // 충전금액 Get
      $outString = "Click ok";
    }else{
      ob_start();
      include __DIR__ . '/../templates/charging.html.php';
      $outString = ob_get_clean();
    }    
  }catch(PDOException $e){
    $outString='<p>Error : ' . $e->getMessage(). $e->getFile(). ' Line : ' . $e->getLine() .'</p>';
  }
  include __DIR__ .'/../templates/layout.html.php';