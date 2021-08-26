<?php
 try{
  include_once __DIR__ .'/../includes/DbConnect.php';         // db 연결
  include_once __DIR__ .'/../includes/userInformation.php';   // 로그인 유저정보
  include_once __DIR__ .'/../includes/Userfunction.php';      // SQL Class
  
  $usersFunction = new Userfunction($pdo);  // SQL Class 생성
  $userid = htmlspecialchars($_GET['id'], ENT_QUOTES, 'UTF-8');              // 로그인 유저
  $pageid = intval(htmlspecialchars($_GET['pageid'], ENT_QUOTES, 'UTF-8'));  // 게시글 id
  $modifyCheck = htmlspecialchars($_POST['modify'], ENT_QUOTES, 'UTF-8');    // 수정버튼 클릭체크
  
  if(!empty($modifyCheck)){   // 게시글 수정 후
    $modify_title = htmlspecialchars($_POST['modify_title'], ENT_QUOTES, 'UTF-8');              // 수정 제목
    $modify_discription = htmlspecialchars($_POST['modify_discription'], ENT_QUOTES, 'UTF-8');  // 수정 내용
    
 // *************** 수정된 게시글 업로드 ( Update ) *************** //     
    $sql = 'UPDATE `writing` SET `title` = :title, `discription` = :discription WHERE `id`= :id';
    $param = [
      'title'=>$modify_title,
      'discription'=>$modify_discription,
      'id'=>$pageid
    ];
    $usersFunction->uploadData($sql, $param);
    
    header('location: writingView.php' . $user . '&pageid=' . $pageid);
  }else{    // 게시글 수정 전
 // *************** 수정 할 게시글내용 ( Select ) *************** //
  // Get으로 엏은 pageid로 찾음
    $sql = 'SELECT `user_id`, `title`, `discription` FROM `writing` WHERE `id` = ' . $pageid;
    $view = $usersFunction->seachQuery($sql);     // 글 작성자 정보
    
    ob_start();
    include __DIR__ .'/../templates/writingModify.html.php';
    $outString = ob_get_clean();
  }
  
 }catch(PDOException $e){
  $outString='<p>Error : ' . $e->getMessage(). $e->getFile(). ' Line : ' . $e->getLine() .'</p>';
 }
 
 include __DIR__ .'/../templates/layout.html.php';