<?php
 try{
  include_once __DIR__ .'/../includes/DbConnect.php';         // db 연결
  include_once __DIR__ .'/../includes/userInformation.php';   // 로그인 유저정보
  include_once __DIR__ .'/../includes/Userfunction.php';      // SQL Class
  
  $usersFunction = new Userfunction($pdo);  // SQL Class 생성
  $userid = htmlspecialchars($_GET['id'], ENT_QUOTES, 'UTF-8');                                // 로그인 유저
  $pageid = intval(htmlspecialchars($_GET['pageid'], ENT_QUOTES, 'UTF-8'));                    // 게시글 id

// ******************* pageid로 현제 페이지 Delete ******************* //
  $sql='DELETE FROM `writing` WHERE `id` = :id';
  $param = [
    'id'=>$pageid
  ];
  $usersFunction->uploadData($sql, $param);
  
// ******************* pageid로 현제 페이지 댓글 Delete ******************* //
  $sql='DELETE FROM `comment` WHERE `writing_id` = :writing_id';
  $param = [
    'writing_id'=>$pageid
  ];
  $usersFunction->uploadData($sql, $param);
  
// 게시글 삭제 후 이동
  header('location: writing.php' . $user);
  
 }catch(PDOException $e){
  $outString='<p>Error : ' . $e->getMessage(). $e->getFile(). ' Line : ' . $e->getLine() .'</p>';
 }