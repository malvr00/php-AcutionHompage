<?php
 try{
  include_once __DIR__ .'/../includes/DbConnect.php';         // db 연결
  include_once __DIR__ .'/../includes/userInformation.php';   // 로그인 유저정보
  include_once __DIR__ .'/../includes/Userfunction.php';      // SQL Class
  
  $usersFunction = new Userfunction($pdo);  // SQL Class 생성
  $userid = $_GET['id'];      // 로그인 유저
  $formTitle = htmlspecialchars($_POST['title'], ENT_QUOTES, 'UTF-8');          // 게시글 제목
  $discription = htmlspecialchars($_POST['discription'], ENT_QUOTES, 'UTF-8');  // 게시글 내용
  
 // ********************** 게시글 Upload ( INSERT )********************** //
  $sql = 'INSERT INTO `writing` SET `user_id` = :user_id, `title` = :title, `discription` = :discription';
  $param = [
    'user_id'=>$userid,
    'title'=>$formTitle,
    'discription'=>$discription
  ];
  $usersFunction->uploadData($sql,$param);
  header('location: writing.php?id=' . $userid);
  
 }catch(PDOException $e){
  $outString='<p>Error : ' . $e->getMessage(). $e->getFile(). ' Line : ' . $e->getLine() .'</p>';
 }
 