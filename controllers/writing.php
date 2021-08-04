<?php
try{
  include_once __DIR__ .'/../includes/DbConnect.php'; // db 연결
  $title = 'User writing';
  
// 유저 게시글 query
  $sql = 'SELECT * FROM `writing`';
  $result = $pdo->query($sql);

// Form 버퍼저장
  ob_start();
  include __DIR__ .'/../templates/writingForm.html.php';
  $outString = ob_get_clean();
  
}catch(PDOException $e){
  // 임시
  $outString='<p>Error : ' . $e->getMessage(). $e->getFile(). ' Line : ' . $e->getLine() .'</p>';
}
include __DIR__ .'/../templates/layout.html.php';