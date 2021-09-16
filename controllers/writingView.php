<?php
 try{
  include_once __DIR__ .'/../includes/DbConnect.php';         // db 연결
  include_once __DIR__ .'/../includes/userInformation.php';   // 로그인 유저정보
  include_once __DIR__ .'/../includes/Userfunction.php';      // SQL Class
  
  $usersFunction = new Userfunction($pdo);  // SQL Class 생성
  $userid = htmlspecialchars($_GET['id'], ENT_QUOTES, 'UTF-8');              // 로그인 유저 id
  $pageid = intval(htmlspecialchars($_GET['pageid'], ENT_QUOTES, 'UTF-8'));  // 게시글 id

// *************** 클릭한 게시글내용 ( Select ) *************** //
  // Get으로 은 pageid로 찾음
  $sql = 'SELECT `user_id`, `title`, `discription` FROM `writing` WHERE `id` = ' . $pageid;
  $view = $usersFunction->seachQuery($sql);     // 글 작성자 정보
  
 // 글 작성자만 수정버튼 보이도록 변수지정
  $userConfirm = ($userid == $view[0]['user_id'])?true:false;     

// *************** 게시글 댓글정보 ( Select ) *************** //
  $sql = 'SELECT * FROM `comment` WHERE `writing_id` = ' . $pageid;
  $comments = $usersFunction->seachQuery($sql);

  ob_start();
  include __DIR__ .'/../templates/writingView.html.php';
  $outString = ob_get_clean();
  
 }catch(PDOException $e){
  $outString='<p>Error : ' . $e->getMessage(). $e->getFile(). ' Line : ' . $e->getLine() .'</p>';
 }
 include __DIR__ .'/../templates/layout.html.php';
 
