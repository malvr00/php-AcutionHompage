<?php
  try{
    include_once __DIR__ .'/../includes/DbConnect.php';         // db 연결
    include_once __DIR__ .'/../includes/userInformation.php';   // 로그인 유저정보
    include_once __DIR__ .'/../includes/Userfunction.php';      // SQL Class
    
    $userId = $_GET['?id'];                   // user Id
    $auctionId = $_GET['auction'];            // auction id
    $usersFunction = new Userfunction($pdo);  // SQL Class 생성
    
  // ********** SQL Query Select ( 클릭한 물품 Seach ) ********** /
    $sql = 'SELECT * FROM `article` WHERE `article_id` = ' . $auctionId;
  // ******물품등록한 유저 정보****** /
    $result1 = $usersFunction->seachQurey($sql);
    
  // ********** 경매물품 입찰&낙찰 Table ********** /
    $sql = 'SELECT * FROM `auctionItems` WHERE `items_articleId` = ' . $auctionId;
  // ********** 경매 입찰 & 낙찰 현황정보 **********/
    $buyuser = $usersFunction->seachQurey($sql);
  
  // 입찰 낙찰 정보
    $price = (int)$price2 = htmlspecialchars($_POST['items_price'], ENT_QUOTES, 'UTF-8');    // 입찰 가격 정보
    $sell = (int)$sell2 = htmlspecialchars($_POST['article_sell'], ENT_QUOTES, 'UTF-8');    // 낙찰 가격 정보
    
    if(!empty($price)){
      if($price < $buyuser[0]['items_price'] +1){   // 현재 입찰 가격보다 금액이 낮으면 return
        echo '<script name="javascript"> window.alert("The current price is lower than the original price. Please re-enter."); history.go(-1);</script>';
      }else{
        
      }
    }
    ob_start();
    include __DIR__ .'/../templates/auctiondetail.html.php';
    $outString = ob_get_clean();
    
  }catch(PDOException $e){
    $outString='<p>Error : ' . $e->getMessage(). $e->getFile(). ' Line : ' . $e->getLine() .'</p>';
  }
  include __DIR__ .'/../templates/layout.html.php';