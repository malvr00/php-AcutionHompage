<?php
 try{
  include_once __DIR__ .'/../includes/DbConnect.php';         // db ����
  include_once __DIR__ .'/../includes/userInformation.php';   // �α��� ��������
  include_once __DIR__ .'/../includes/Userfunction.php';      // SQL Class
  
  $usersFunction = new Userfunction($pdo);  // SQL Class ����
  $userid = $_GET['id'];      // �α��� ����
  $formTitle = htmlspecialchars($_POST['title'], ENT_QUOTES, 'UTF-8');          // �Խñ� ����
  $discription = htmlspecialchars($_POST['discription'], ENT_QUOTES, 'UTF-8');  // �Խñ� ����
  
 // ********************** �Խñ� Upload ( INSERT )********************** //
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
 