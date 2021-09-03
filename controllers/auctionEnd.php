<?
<?php
 try{
  include_once __DIR__ .'/../includes/DbConnect.php';         // db ����
  include_once __DIR__ .'/../includes/userInformation.php';   // �α��� ��������
  include_once __DIR__ .'/../includes/Userfunction.php';      // SQL Class
  
  $usersFunction = new Userfunction($pdo);  // SQL Class ����
  $userid = htmlspecialchars($_GET['id'], ENT_QUOTES, 'UTF-8');                 // �α��� ����
  $auctionid = intval(htmlspecialchars($_GET['auction'], ENT_QUOTES, 'UTF-8')); // ��ǰ id*/
  

// *************** ���� ���� & �ݾ� ���� ������ *************** //
  $sql = 'SELECT * FROM `auctionItems` WHERE `items_articleId` = ' . $auctionid;
  $buyUser = $usersFunction->seachQuery($sql);
  
// *************** �Ǹ��� ���� ���� ������ *************** //  
  $sql = 'SELECT * FROM `userInfor` WHERE `user_id` = \'' . $userid . '\'';
  $payUserInfor = $usersFunction->seachQuery($sql);

// *************** ���� �������� ������ *************** //
  $sql = 'SELECT * FROM `userInfor` WHERE `user_id` = \'' . $buyUser[0]['user_id'] . '\'';
  $buyUserInfor = $usersFunction->seachQuery($sql);
  
 // Point ����
  $payUserPoint = (int)$buyUser[0]['items_price'] + (int)$payUserInfor[0]['infor_point'];


// *************** �Ǹ��ڹ�ǰ ���ε� ( ��ǰ��� �� �˸� ) *************** //
  $sql = 'UPDATE `article` SET `article_end` = :article_end WHERE article_id = :article_id';
  $param = [
    'article_end'=>2,
    'article_id'=>$auctionid
  ];
  $usersFunction->uploadData($sql, $param);
  
// *************** �Ǹ��� ����Ʈ���� ���ε� ( ��ǰ��� �� �˸� ) ***************
  $sql = 'UPDATE `userInfor` SET `infor_point` = :infor_point WHERE `user_id` = :user_id';
  $param =[
    'infor_point'=>$payUserPoint,
    'user_id'=>$userid
  ];
  $usersFunction->uploadData($sql,$param);
  
// *************** ������ ��ǰ  ���ε� ( ������ ���� ) *************** //
  $sql = 'UPDATE `auctionItems` SET `items_sfb` = :items_sfb WHERE `items_articleId` = :items_articleId';
  $param = [
    'items_sfb'=>$buyUser[0]['user_id'],
    'items_articleId'=>$auctionid
  ];
  $usersFunction->uploadData($sql, $param);
  
// *************** ���� ��������  ���ε� ( UpDate) *************** //
  // ���� ������ ��ǰ �� Update
  $sql = 'SELECT COUNT(`items_sfb`) FROM `auctionItems` WHERE `items_sfb`=\'' . $buyUser[0]['user_id'] . '\'';
  $result2 = $usersFunction->seachQuery($sql);
  $sfbCnt = intval($result2[0][0]);   // ���� ����

  $sql = 'UPDATE `userInfor` SET `infor_sfb` = :infor_sfb WHERE `user_id` = :user_id';
  $param = [
    'infor_sfb'=>$sfbCnt,
    'user_id'=>$buyUser[0]['user_id']
  ];
  $usersFunction->uploadData($sql, $param);

  header('location: ../php/index.php' . $user);
  
 }catch(PDOException $e){
  $outString='<p>Error : ' . $e->getMessage(). $e->getFile(). ' Line : ' . $e->getLine() .'</p>';
 }