<?php
  try{
    include_once __DIR__ .'/../includes/DbConnect.php';         // db 연결
    include_once __DIR__ .'/../includes/userInformation.php';   // 로그인 유저정보
    include_once __DIR__ .'/../includes/Userfunction.php';      // SQL Class
    
    $usersFunction = new Userfunction($pdo);  // SQL Class 생성
    $userid = $_GET['id'];                    // user id
    
  // ************* 유저상세정보 SELECT ************* //
    $sql = 'SELECT * FROM `userInfor` WHERE `user_id`=\'' . $userid . '\'';
    $result = $usersFunction->seachQurey($sql);
    
    ob_start();
    include __DIR__ .'/../templates/userdetail.html.php';
    $outString = ob_get_clean();
    
  }catch(PDOException $e){
    $outString='<p>Error : ' . $e->getMessage(). $e->getFile(). ' Line : ' . $e->getLine() .'</p>';
  }
  
  include __DIR__ .'/../templates/layout.html.php';