<?php
 try{
  include_once __DIR__ .'/../includes/DbConnect.php';         // db 연결
  include_once __DIR__ .'/../includes/userInformation.php';   // 로그인 유저정보
  include_once __DIR__ .'/../includes/Userfunction.php';      // SQL Class
  
  $usersFunction = new Userfunction($pdo);  // SQL Class 생성
  $userid = htmlspecialchars($_GET['id'], ENT_QUOTES, 'UTF-8');                                // 로그인 유저
  $auctionid = intval(htmlspecialchars($_GET['auction'], ENT_QUOTES, 'UTF-8'));                // 물품 id
  
// *************** 입찰 유저 & 금액 정보 가져옴 *************** //
  $sql = 'SELECT * FROM `auctionItems` WHERE `items_articleId` = ' . $auctionid;
  $payUser = $usersFunction->seachQuery($sql);
  
// *************** 입찰자 유저 정보 가져옴 *************** //  
  $sql = 'SELECT * FROM `userInfor` WHERE `user_id` = \'' . $payUser[0]['user_id'] . '\'';
  $payUserInfor = $usersFunction->seachQuery($sql);
  
 // Point 정산
  $payUserPoint = (int)$payUser[0]['items_price'] + (int)$payUserInfor[0]['infor_point'];
  
// *************** 입찰자 유저 Point 정산 ( Update ) *************** //
  $sql = 'UPDATE `userInfor` SET `infor_point` = :infor_point WHERE `user_id` = :user_id';
  $param =[
    'infor_point'=>$payUserPoint,
    'user_id'=>$payUser[0]['user_id']
  ];
  $usersFunction->uploadData($sql,$param);
  
// ******************* 경매물품 Delete ******************* //
  $sql='DELETE FROM `article` WHERE `article_id` = :article_id';
  $param = [
    'article_id'=>$auctionid
  ];
  $usersFunction->uploadData($sql, $param);

// ******************* 경매물품 현황  Delete ******************* //
  $sql='DELETE FROM `auctionItems` WHERE `items_articleId` = :items_articleId';
  $param = [
    'items_articleId'=>$auctionid
  ];
  $usersFunction->uploadData($sql, $param);
  
// ************************* userDetail 수정( 등록물품 수  증가 ) ********************************************/
 // 경매 진행중인 물품만 Count
  $sql = 'SELECT COUNT(`user_id`) FROM `article` WHERE `user_id`=\'' . $_GET['id'] . '\' AND `article_end` = 1';
  $result = $usersFunction->seachQuery($sql);
  $itemCnt = intval($result[0][0]);   // 물품 총 등록 개수
  
 // UserDetail Update ( 등록물품 수 업데이트 )
  $sql = 'UPDATE `userInfor` SET `infor_auctionCnt` = :infor_auctionCnt WHERE `user_id` = :user_id';
  $param = [
    'infor_auctionCnt'=>$itemCnt,
    'user_id'=>$_GET['id']
  ];
  $usersFunction->uploadData($sql, $param);
  
// 물품 삭제 후 이동
  header('location: ../php/index.php' . $user);
  
 }catch(PDOException $e){
  $outString='<p>Error : ' . $e->getMessage(). $e->getFile(). ' Line : ' . $e->getLine() .'</p>';
 }