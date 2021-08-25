<?php
try{
  include_once __DIR__ .'/../includes/DbConnect.php';         // db 연결
  include_once __DIR__ .'/../includes/userInformation.php';   // 로그인 유저정보
  include_once __DIR__ .'/../includes/Userfunction.php';      // SQL Class
  $title = 'User writing';
  
  $usersFunction = new Userfunction($pdo);  // SQL Class 생성
  $write = htmlspecialchars($_POST['write'], ENT_QUOTES, 'UTF-8'); // Button 확인용
  $userid = $_GET['id'];      // 로그인 유저
  
  if(!empty($write)){
  // 게시글 작성Form 이동
    ob_start();
    include __DIR__ .'/../templates/writingForm2.html.php';
    $outString = ob_get_clean();
  }else{
    // 현재 페이지 쪽수
    if(isset($_GET['page'])){
      $page = htmlspecialchars($_GET['page'], ENT_QUOTES, 'UTF-8');
    }else{
      $page = 1;  // 없으면 1
    }
    
    $listpage = 10;                                   // 한 페이지당 게시글 10개 씩 나타냄
    $sql = 'SELECT COUNT(`id`) FROM `writing`';
    $total_cnt = $usersFunction->seachQuery($sql);    // 게시글 작성 page 수
    $total_page = ceil($total_cnt[0][0]/$listpage);   // 페이지 총 쪽수
    $nowpage = $listpage * ($page - 1);               // Table row 번째
    
  // 페이지 쪽 수
    $total_block = ceil($total_page/$listpage);       // 페이지블럭 10개씩 1개묶음
    $block = ceil($page/$listpage);                   // 몇 번째 블럭에 있는지
    $first = (($block-1) * $listpage) + 1;            // 첫 번째 페이지
    $last = $block * $listpage;                       // 마지막 페이지

  // ******************** 유저 게시글 Select Limit  ( 10개씩 불러옴) ******************** //
    $sql = 'SELECT * FROM `writing` limit ' . $nowpage . ', ' . $listpage;
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