<?
<?php
 try{
  include_once __DIR__ .'/../includes/DbConnect.php';         // db 연결
  include_once __DIR__ .'/../includes/userInformation.php';   // 로그인 유저정보
  include_once __DIR__ .'/../includes/Userfunction.php';      // SQL Class
  
  $usersFunction = new Userfunction($pdo);  // SQL Class 생성
  $userid = htmlspecialchars($_GET['id'], ENT_QUOTES, 'UTF-8');                 // 로그인 유저
  $auctionid = intval(htmlspecialchars($_GET['auction'], ENT_QUOTES, 'UTF-8')); // 물품 id*/
  

// *************** 낙찰 유저 & 금액 정보 가져옴 *************** //
  $sql = 'SELECT * FROM `auctionItems` WHERE `items_articleId` = ' . $auctionid;
  $buyUser = $usersFunction->seachQuery($sql);
  
// *************** 판매자 유저 정보 가져옴 *************** //  
  $sql = 'SELECT * FROM `userInfor` WHERE `user_id` = \'' . $userid . '\'';
  $payUserInfor = $usersFunction->seachQuery($sql);

// *************** 낙찰 유저정보 가져옴 *************** //
  $sql = 'SELECT * FROM `userInfor` WHERE `user_id` = \'' . $buyUser[0]['user_id'] . '\'';
  $buyUserInfor = $usersFunction->seachQuery($sql);
  
 // Point 정산
  $payUserPoint = (int)$buyUser[0]['items_price'] + (int)$payUserInfor[0]['infor_point'];


// *************** 판매자물품 업로드 ( 물품경매 끝 알림 ) *************** //
  $sql = 'UPDATE `article` SET `article_end` = :article_end WHERE article_id = :article_id';
  $param = [
    'article_end'=>2,
    'article_id'=>$auctionid
  ];
  $usersFunction->uploadData($sql, $param);
  
// *************** 판매자 포인트정산 업로드 ( 물품경매 끝 알림 ) ***************
  $sql = 'UPDATE `userInfor` SET `infor_point` = :infor_point WHERE `user_id` = :user_id';
  $param =[
    'infor_point'=>$payUserPoint,
    'user_id'=>$userid
  ];
  $usersFunction->uploadData($sql,$param);
  
// *************** 낙찰자 물품  업로드 ( 낙찰자 저장 ) *************** //
  $sql = 'UPDATE `auctionItems` SET `items_sfb` = :items_sfb WHERE `items_articleId` = :items_articleId';
  $param = [
    'items_sfb'=>$buyUser[0]['user_id'],
    'items_articleId'=>$auctionid
  ];
  $usersFunction->uploadData($sql, $param);
  
// *************** 낙찰 유저정보  업로드 ( UpDate) *************** //
  // 유저 낙찰한 물품 수 Update
  $sql = 'SELECT COUNT(`items_sfb`) FROM `auctionItems` WHERE `items_sfb`=\'' . $buyUser[0]['user_id'] . '\'';
  $result2 = $usersFunction->seachQuery($sql);
  $sfbCnt = intval($result2[0][0]);   // 낙찰 개수

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