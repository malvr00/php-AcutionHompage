<?php
 try{
  include_once __DIR__ .'/../includes/DbConnect.php';         // db 연결
  include_once __DIR__ .'/../includes/userInformation.php';   // 로그인 유저정보
  include_once __DIR__ .'/../includes/Userfunction.php';      // SQL Class
  
  $usersFunction = new Userfunction($pdo);  // SQL Class 생성
  $userid = htmlspecialchars($_GET['id'], ENT_QUOTES, 'UTF-8');                                // 로그인 유저
  $pageid = intval(htmlspecialchars($_GET['pageid'], ENT_QUOTES, 'UTF-8'));                    // 게시글 id
  $comment_discription = htmlspecialchars($_POST['comment_discription'], ENT_QUOTES, 'UTF-8'); // 댓글내용
  
// ************** 게시글 댓글추가 (Insert) ************** //
  $sql = 'INSERT INTO `comment` SET `writing_id` = :writing_id, `user_id` = :user_id, `discription` = :discription';
  $param = [
    'writing_id'=>$pageid,
    'user_id'=>$userid,
    'discription'=>$comment_discription
  ];
  $usersFunction->uploadData($sql, $param);

// 댓글 추가 후 게시글로 이동
  header('location: writingView.php' . $user . '&pageid=' . $pageid);
  
 }catch(PDOException $e){
  $outString='<p>Error : ' . $e->getMessage(). $e->getFile(). ' Line : ' . $e->getLine() .'</p>';
 }