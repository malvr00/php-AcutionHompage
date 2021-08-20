<?php
try{
  include_once __DIR__ .'/../includes/DbConnect.php';         // db 연결
  include_once __DIR__ .'/../includes/userInformation.php';   // 로그인 유저정보
  include_once __DIR__ .'/../includes/Userfunction.php';      // SQL Class
  $title = 'User writing';
  
  $usersFunction = new Userfunction($pdo);  // SQL Class 생성
  $write = htmlspecialchars($_POST['write'], ENT_QUOTES, 'UTF-8'); // Button 확인용
  
  if(!empty($write)){
  // 게시글 작성Form 이동
    ob_start();
    include __DIR__ .'/../templates/writingForm2.html.php';
    $outString = ob_get_clean();
  }else{
    // 유저 게시글 query
    $sql = 'SELECT * FROM `writing`';
    $result = $usersFunction->seachQuery($sql);
    
  // Form 버퍼저장
    ob_start();
    include __DIR__ .'/../templates/writingForm.html.php';
    $outString = ob_get_clean();
  }
}catch(PDOException $e){
  // 임시
  $outString='<p>Error : ' . $e->getMessage(). $e->getFile(). ' Line : ' . $e->getLine() .'</p>';
}
include __DIR__ .'/../templates/layout.html.php';