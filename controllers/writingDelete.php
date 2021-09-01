<?php
 try{
  include_once __DIR__ .'/../includes/DbConnect.php';         // db ����
  include_once __DIR__ .'/../includes/userInformation.php';   // �α��� ��������
  include_once __DIR__ .'/../includes/Userfunction.php';      // SQL Class
  
  $usersFunction = new Userfunction($pdo);  // SQL Class ����
  $userid = htmlspecialchars($_GET['id'], ENT_QUOTES, 'UTF-8');                                // �α��� ����
  $pageid = intval(htmlspecialchars($_GET['pageid'], ENT_QUOTES, 'UTF-8'));                    // �Խñ� id

// ******************* pageid�� ���� ������ Delete ******************* //
  $sql='DELETE FROM `writing` WHERE `id` = :id';
  $param = [
    'id'=>$pageid
  ];
  $usersFunction->uploadData($sql, $param);
  
// ******************* pageid�� ���� ������ ��� Delete ******************* //
  $sql='DELETE FROM `comment` WHERE `writing_id` = :writing_id';
  $param = [
    'writing_id'=>$pageid
  ];
  $usersFunction->uploadData($sql, $param);
  
// �Խñ� ���� �� �̵�
  header('location: writing.php' . $user);
  
 }catch(PDOException $e){
  $outString='<p>Error : ' . $e->getMessage(). $e->getFile(). ' Line : ' . $e->getLine() .'</p>';
 }