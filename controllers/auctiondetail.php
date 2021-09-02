<?php
  try{
    include_once __DIR__ .'/../includes/DbConnect.php';         // db 연결
    include_once __DIR__ .'/../includes/userInformation.php';   // 로그인 유저정보
    include_once __DIR__ .'/../includes/Userfunction.php';      // SQL Class

    $userId = $_GET['?id'];                   // user id
    $auctionId = $_GET['auction'];            // auction id
    $usersFunction = new Userfunction($pdo);  // SQL Class 생성

  // ********** SQL Query Select ( 클릭한 물품 Seach ) ********** /
    // 판매자 정보
    $sql = 'SELECT * FROM `article` WHERE `article_id` = ' . $auctionId;
    $result1 = $usersFunction->seachQuery($sql);
    
    // 글 작성자만 수정버튼 보이도록 변수지정
    $userConfirm = ($userId == $result1[0]['user_id'])?true:false; 
    
  // ********** 경매 입찰 & 낙찰 현황정보 **********/
    $sql = 'SELECT * FROM `auctionItems` WHERE `items_articleId` = ' . $auctionId;
    $buyuser = $usersFunction->seachQuery($sql);
  // 입찰 낙찰 정보
    $price = intval(htmlspecialchars($_POST['items_price'], ENT_QUOTES, 'UTF-8'));    // 입찰 가격 정보
    $sell = intval(htmlspecialchars($_POST['article_sell'], ENT_QUOTES, 'UTF-8'));    // 낙찰 가격 정보
    
  // **************** 유저 가지고있던 point 불러옴 (userInfor Table)**************** //
    // 구매자 Point
    $sql = 'SELECT `infor_point` FROM `userInfor` WHERE `user_id` = \'' . $userId . '\'';
    $payUserPoint = $usersFunction->seachQuery($sql);
    
    // 판매자 Point
    $sql = 'SELECT `user_id`, `infor_point` FROM `userInfor` WHERE `user_id` = \'' . $result1[0]['user_id'] . '\'';
    $sellerUserPoint = $usersFunction->seachQuery($sql);
    
    // 입찰대기자 Point
    $sql = 'SELECT `user_id`, `infor_point` FROM `userInfor` WHERE `user_id` = \'' . $buyuser[0]['user_id'] . '\'';
    $priceUserPoint = $usersFunction->seachQuery($sql);
    
  // 페이지 접속시 조회수 1증가
    $view = $result1[0]['article_views'] + 1;
    $sql = 'UPDATE `article` SET `article_views` = :article_views WHERE `article_id` = :article_id';
    $param = [
      'article_views'=>$view,
      'article_id'=>$auctionId
    ];
    $usersFunction->uploadData($sql, $param);

    if(!empty($price)){ // 입찰가격 Update
      if($price > (int)$payUserPoint[0]['infor_point']){  // 유저가 가지고 있는 포인트가 입찰 가격보다 낮을 경우
      // 포인트가 낮으면 경고문 발생
        echo '<script name="javascript"> window.alert("Not enough points.."); history.go(-1);</script>';
      }else{
        if($price < $buyuser[0]['items_price'] +1){      // 현재 입찰 가격보다 금액이 낮으면 return
          echo '<script name="javascript"> window.alert("The current price is lower than the original price. Please re-enter."); history.go(-1);</script>';
        }else{  // 보유 포인트가 충족하면 진행
        // ********** 다른유저 입찰 시 Point Back ( Update ) ********** //
          $backPoint = (int)$buyuser[0]['items_price'] + (int)$priceUserPoint[0]['infor_point'];
          $sql = 'UPDATE `userInfor` SET `infor_point` = :infor_point WHERE `user_id` = :user_id';
          $param = [
            'infor_point' => $backPoint,
            'user_id' => $priceUserPoint[0]['user_id']
          ];
          $usersFunction->uploadData($sql, $param);
        // ********** UserDetail Point Update ********** //
          // point 정산( 판매자 Point 정산)
          $totalPoint = (int)$payUserPoint[0]['infor_point'] - $price;
          $sql = 'UPDATE `userInfor` SET `infor_point` = :infor_point WHERE `user_id` = :user_id';
          $param = [
            'infor_point'=>$totalPoint,
            'user_id'=>$userId
          ];
          $usersFunction->uploadData($sql, $param);
          
        // ********** 유저 입찰 Update ********** //
          $sql = 'UPDATE `auctionItems` SET `user_id` = :user_id, `items_price` = :items_price WHERE `items_articleId` = :items_articleId';
          $param = [
            'user_id'=>$userId,
            'items_price'=>$price,
            'items_articleId'=>$auctionId
          ];
          $usersFunction->uploadData($sql, $param);
          
        // 실시간 입찰 진행현황 업데이트
          $sql = 'SELECT * FROM `auctionItems` WHERE `items_articleId` = ' . $auctionId;
          $buyuser = $usersFunction->seachQuery($sql);
        }
      }
    }else if(!empty($sell)){  // 즉매 Update
      if($sell > (int)$payUserPoint[0]['infor_point']){  // 유저가 가지고 있는 포인트가 즉매 가격보다 낮을 경우
      // 포인트가 낮으면 경고문 발생
        echo '<script name="javascript"> window.alert("Not enough points.."); history.go(-1);</script>';
      }else{  // 보유 포인트가 충족하면 진행
        if( $sell < $result1[0]['article_sell']){   // 현재 낙찰 가격보다 금액이 낮으면 return
        echo '<script name="javascript"> window.alert("The current price is lower than the original price. Please re-enter."); history.go(-1);</script>';
        }else{
        // ********** 유저 입찰 & 낙찰 현황정보 Update ( 낙찰 ) ********** //
        // 누가 낙찰했는지 Upload
          $sql = 'UPDATE `auctionItems` SET `items_sfb` = :items_sfb WHERE `items_articleId` = :items_articleId';
          $param = [
            'items_sfb'=>$userId,
            'items_articleId'=>$auctionId
          ];
          $usersFunction->uploadData($sql, $param);
          
        // ********** 물품 list 낙찰 Update ********** //
        // 물품이 낙찰됐는지 안됐는지 Upload
          $sql = 'UPDATE `article` SET `article_end` = :article_end WHERE `article_id` = :article_id';
          $param = [
            'article_end'=>2,   // 낙찰됐는지 안됐는지 확인. 1 = 낙찰x,  2 = 낙찰o
            'article_id'=>$auctionId
          ];
          $usersFunction->uploadData($sql, $param);
          
        // ********** UserDetail 낙찰 Update ********** //
          // 유저 낙찰한 물품 수 Update
          $sql = 'SELECT COUNT(`items_sfb`) FROM `auctionItems` WHERE `items_sfb`=\'' . $userId . '\'';
          $result2 = $usersFunction->seachQuery($sql);
          $sfbCnt = intval($result2[0][0]);   // 낙찰 개수
          
          $sql = 'UPDATE `userInfor` SET `infor_sfb` = :infor_sfb WHERE `user_id` = :user_id';
          $param = [
            'infor_sfb'=>$sfbCnt,
            'user_id'=>$userId
          ];
          $usersFunction->uploadData($sql, $param);
          
        // ********** UserDetail Point Update ********** //
          // point 정산( 판매자 Point 정산)
          $totalPoint1 = (int)$payUserPoint[0]['infor_point'] + (int)$sellerUserPoint[0]['infor_point'];
          $sql = 'UPDATE `userInfor` SET `infor_point` = :infor_point WHERE `user_id` = :user_id';
          $param = [
            'infor_point'=>$totalPoint1,
            'user_id'=>$sellerUserPoint[0]['user_id']
          ];
          $usersFunction->uploadData($sql, $param);
          
          // point 정산 ( 구매자 Point 정산 )
          $totalPoint2 = (int)$payUserPoint[0]['infor_point'] - $sell;
          $sql = 'UPDATE `userInfor` SET `infor_point` = :infor_point WHERE `user_id` = :user_id';
          $param = [
            'infor_point'=>$totalPoint2,
            'user_id'=>$userId
          ];
          $usersFunction->uploadData($sql, $param);
          
          header('location: ../php/index.php?id=' . $userId . '&sell=' . 2);
        }
      }
    }
    ob_start();
    include __DIR__ .'/../templates/auctiondetail.html.php';
    $outString = ob_get_clean();
    
  }catch(PDOException $e){
    $outString='<p>Error : ' . $e->getMessage(). $e->getFile(). ' Line : ' . $e->getLine() .'</p>';
  }
  include __DIR__ .'/../templates/layout.html.php';