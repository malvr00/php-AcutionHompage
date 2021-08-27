<?php
 try{
  include_once __DIR__ .'/../includes/DbConnect.php';         // db ����
  include_once __DIR__ .'/../includes/userInformation.php';   // �α��� ��������
  include_once __DIR__ .'/../includes/Userfunction.php';      // SQL Class
  
  $usersFunction = new Userfunction($pdo);  // SQL Class ����
  $userid = htmlspecialchars($_GET['id'], ENT_QUOTES, 'UTF-8');                                // �α��� ����
  $auctionid = intval(htmlspecialchars($_GET['auction'], ENT_QUOTES, 'UTF-8'));                // ��ǰ id
  
// *************** ���� ���� & �ݾ� ���� ������ *************** //
  $sql = 'SELECT * FROM `auctionItems` WHERE `items_articleId` = ' . $auctionid;
  $payUser = $usersFunction->seachQuery($sql);
  
// *************** ������ ���� ���� ������ *************** //  
  $sql = 'SELECT * FROM `userInfor` WHERE `user_id` = \'' . $payUser[0]['user_id'] . '\'';
  $payUserInfor = $usersFunction->seachQuery($sql);
  
 // Point ����
  $payUserPoint = (int)$payUser[0]['items_price'] + (int)$payUserInfor[0]['infor_point'];
  
// *************** ������ ���� Point ���� ( Update ) *************** //
  $sql = 'UPDATE `userInfor` SET `infor_point` = :infor_point WHERE `user_id` = :user_id';
  $param =[
    'infor_point'=>$payUserPoint,
    'user_id'=>$payUser[0]['user_id']
  ];
  $usersFunction->uploadData($sql,$param);
  
// ******************* ��Ź�ǰ Delete ******************* //
  $sql='DELETE FROM `article` WHERE `article_id` = :article_id';
  $param = [
    'article_id'=>$auctionid
  ];
  $usersFunction->uploadData($sql, $param);

// ******************* ��Ź�ǰ ��Ȳ  Delete ******************* //
  $sql='DELETE FROM `auctionItems` WHERE `items_articleId` = :items_articleId';
  $param = [
    'items_articleId'=>$auctionid
  ];
  $usersFunction->uploadData($sql, $param);

// ��ǰ ���� �� �̵�
  header('location: ../php/index.php' . $user);
  
 }catch(PDOException $e){
  $outString='<p>Error : ' . $e->getMessage(). $e->getFile(). ' Line : ' . $e->getLine() .'</p>';
 }