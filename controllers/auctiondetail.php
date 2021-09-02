<?php
  try{
    include_once __DIR__ .'/../includes/DbConnect.php';         // db ����
    include_once __DIR__ .'/../includes/userInformation.php';   // �α��� ��������
    include_once __DIR__ .'/../includes/Userfunction.php';      // SQL Class

    $userId = $_GET['?id'];                   // user id
    $auctionId = $_GET['auction'];            // auction id
    $usersFunction = new Userfunction($pdo);  // SQL Class ����

  // ********** SQL Query Select ( Ŭ���� ��ǰ Seach ) ********** /
    // �Ǹ��� ����
    $sql = 'SELECT * FROM `article` WHERE `article_id` = ' . $auctionId;
    $result1 = $usersFunction->seachQuery($sql);
    
    // �� �ۼ��ڸ� ������ư ���̵��� ��������
    $userConfirm = ($userId == $result1[0]['user_id'])?true:false; 
    
  // ********** ��� ���� & ���� ��Ȳ���� **********/
    $sql = 'SELECT * FROM `auctionItems` WHERE `items_articleId` = ' . $auctionId;
    $buyuser = $usersFunction->seachQuery($sql);
  // ���� ���� ����
    $price = intval(htmlspecialchars($_POST['items_price'], ENT_QUOTES, 'UTF-8'));    // ���� ���� ����
    $sell = intval(htmlspecialchars($_POST['article_sell'], ENT_QUOTES, 'UTF-8'));    // ���� ���� ����
    
  // **************** ���� �������ִ� point �ҷ��� (userInfor Table)**************** //
    // ������ Point
    $sql = 'SELECT `infor_point` FROM `userInfor` WHERE `user_id` = \'' . $userId . '\'';
    $payUserPoint = $usersFunction->seachQuery($sql);
    
    // �Ǹ��� Point
    $sql = 'SELECT `user_id`, `infor_point` FROM `userInfor` WHERE `user_id` = \'' . $result1[0]['user_id'] . '\'';
    $sellerUserPoint = $usersFunction->seachQuery($sql);
    
    // ��������� Point
    $sql = 'SELECT `user_id`, `infor_point` FROM `userInfor` WHERE `user_id` = \'' . $buyuser[0]['user_id'] . '\'';
    $priceUserPoint = $usersFunction->seachQuery($sql);
    
  // ������ ���ӽ� ��ȸ�� 1����
    $view = $result1[0]['article_views'] + 1;
    $sql = 'UPDATE `article` SET `article_views` = :article_views WHERE `article_id` = :article_id';
    $param = [
      'article_views'=>$view,
      'article_id'=>$auctionId
    ];
    $usersFunction->uploadData($sql, $param);

    if(!empty($price)){ // �������� Update
      if($price > (int)$payUserPoint[0]['infor_point']){  // ������ ������ �ִ� ����Ʈ�� ���� ���ݺ��� ���� ���
      // ����Ʈ�� ������ ��� �߻�
        echo '<script name="javascript"> window.alert("Not enough points.."); history.go(-1);</script>';
      }else{
        if($price < $buyuser[0]['items_price'] +1){      // ���� ���� ���ݺ��� �ݾ��� ������ return
          echo '<script name="javascript"> window.alert("The current price is lower than the original price. Please re-enter."); history.go(-1);</script>';
        }else{  // ���� ����Ʈ�� �����ϸ� ����
        // ********** �ٸ����� ���� �� Point Back ( Update ) ********** //
          $backPoint = (int)$buyuser[0]['items_price'] + (int)$priceUserPoint[0]['infor_point'];
          $sql = 'UPDATE `userInfor` SET `infor_point` = :infor_point WHERE `user_id` = :user_id';
          $param = [
            'infor_point' => $backPoint,
            'user_id' => $priceUserPoint[0]['user_id']
          ];
          $usersFunction->uploadData($sql, $param);
        // ********** UserDetail Point Update ********** //
          // point ����( �Ǹ��� Point ����)
          $totalPoint = (int)$payUserPoint[0]['infor_point'] - $price;
          $sql = 'UPDATE `userInfor` SET `infor_point` = :infor_point WHERE `user_id` = :user_id';
          $param = [
            'infor_point'=>$totalPoint,
            'user_id'=>$userId
          ];
          $usersFunction->uploadData($sql, $param);
          
        // ********** ���� ���� Update ********** //
          $sql = 'UPDATE `auctionItems` SET `user_id` = :user_id, `items_price` = :items_price WHERE `items_articleId` = :items_articleId';
          $param = [
            'user_id'=>$userId,
            'items_price'=>$price,
            'items_articleId'=>$auctionId
          ];
          $usersFunction->uploadData($sql, $param);
          
        // �ǽð� ���� ������Ȳ ������Ʈ
          $sql = 'SELECT * FROM `auctionItems` WHERE `items_articleId` = ' . $auctionId;
          $buyuser = $usersFunction->seachQuery($sql);
        }
      }
    }else if(!empty($sell)){  // ��� Update
      if($sell > (int)$payUserPoint[0]['infor_point']){  // ������ ������ �ִ� ����Ʈ�� ��� ���ݺ��� ���� ���
      // ����Ʈ�� ������ ��� �߻�
        echo '<script name="javascript"> window.alert("Not enough points.."); history.go(-1);</script>';
      }else{  // ���� ����Ʈ�� �����ϸ� ����
        if( $sell < $result1[0]['article_sell']){   // ���� ���� ���ݺ��� �ݾ��� ������ return
        echo '<script name="javascript"> window.alert("The current price is lower than the original price. Please re-enter."); history.go(-1);</script>';
        }else{
        // ********** ���� ���� & ���� ��Ȳ���� Update ( ���� ) ********** //
        // ���� �����ߴ��� Upload
          $sql = 'UPDATE `auctionItems` SET `items_sfb` = :items_sfb WHERE `items_articleId` = :items_articleId';
          $param = [
            'items_sfb'=>$userId,
            'items_articleId'=>$auctionId
          ];
          $usersFunction->uploadData($sql, $param);
          
        // ********** ��ǰ list ���� Update ********** //
        // ��ǰ�� �����ƴ��� �ȵƴ��� Upload
          $sql = 'UPDATE `article` SET `article_end` = :article_end WHERE `article_id` = :article_id';
          $param = [
            'article_end'=>2,   // �����ƴ��� �ȵƴ��� Ȯ��. 1 = ����x,  2 = ����o
            'article_id'=>$auctionId
          ];
          $usersFunction->uploadData($sql, $param);
          
        // ********** UserDetail ���� Update ********** //
          // ���� ������ ��ǰ �� Update
          $sql = 'SELECT COUNT(`items_sfb`) FROM `auctionItems` WHERE `items_sfb`=\'' . $userId . '\'';
          $result2 = $usersFunction->seachQuery($sql);
          $sfbCnt = intval($result2[0][0]);   // ���� ����
          
          $sql = 'UPDATE `userInfor` SET `infor_sfb` = :infor_sfb WHERE `user_id` = :user_id';
          $param = [
            'infor_sfb'=>$sfbCnt,
            'user_id'=>$userId
          ];
          $usersFunction->uploadData($sql, $param);
          
        // ********** UserDetail Point Update ********** //
          // point ����( �Ǹ��� Point ����)
          $totalPoint1 = (int)$payUserPoint[0]['infor_point'] + (int)$sellerUserPoint[0]['infor_point'];
          $sql = 'UPDATE `userInfor` SET `infor_point` = :infor_point WHERE `user_id` = :user_id';
          $param = [
            'infor_point'=>$totalPoint1,
            'user_id'=>$sellerUserPoint[0]['user_id']
          ];
          $usersFunction->uploadData($sql, $param);
          
          // point ���� ( ������ Point ���� )
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