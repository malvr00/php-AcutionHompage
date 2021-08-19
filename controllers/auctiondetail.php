<?php
  try{
    include_once __DIR__ .'/../includes/DbConnect.php';         // db ¿¬°á
    include_once __DIR__ .'/../includes/userInformation.php';   // ·Î±×ÀÎ À¯ÀúÁ¤º¸
    include_once __DIR__ .'/../includes/Userfunction.php';      // SQL Class

    $userId = $_GET['?id'];                   // user id
    $auctionId = $_GET['auction'];            // auction id
    $usersFunction = new Userfunction($pdo);  // SQL Class »ý¼º
    
  // ********** SQL Query Select ( Å¬¸¯ÇÑ ¹°Ç° Seach ) ********** /
    $sql = 'SELECT * FROM `article` WHERE `article_id` = ' . $auctionId;
    $result1 = $usersFunction->seachQurey($sql);
    
  // ********** °æ¸Å ÀÔÂû & ³«Âû ÇöÈ²Á¤º¸ **********/
    $sql = 'SELECT * FROM `auctionItems` WHERE `items_articleId` = ' . $auctionId;
    $buyuser = $usersFunction->seachQurey($sql);
    
  // ÀÔÂû ³«Âû Á¤º¸
    $price = (int)$price2 = htmlspecialchars($_POST['items_price'], ENT_QUOTES, 'UTF-8');    // ÀÔÂû °¡°Ý Á¤º¸
    $sell = (int)$sell2 = htmlspecialchars($_POST['article_sell'], ENT_QUOTES, 'UTF-8');    // ³«Âû °¡°Ý Á¤º¸

    if(!empty($price)){ // ÀÔÂû°¡°Ý Update
      if($price < $buyuser[0]['items_price'] +1){   // ÇöÀç ÀÔÂû °¡°Ýº¸´Ù ±Ý¾×ÀÌ ³·À¸¸é return
        echo '<script name="javascript"> window.alert("The current price is lower than the original price. Please re-enter."); history.go(-1);</script>';
      }else{
      // ********** À¯Àú ÀÔÂû Update ********** //
        $sql = 'UPDATE `auctionItems` SET `user_id` = :user_id, `items_price` = :items_price WHERE `items_articleId` = :items_articleId';
        $param = [
          'user_id'=>$userId,
          'items_price'=>$price,
          'items_articleId'=>$auctionId
        ];
        $usersFunction->uploadData($sql, $param);
        
      // ½Ç½Ã°£ ÀÔÂû ÁøÇàÇöÈ² ¾÷µ¥ÀÌÆ®
        $sql = 'SELECT * FROM `auctionItems` WHERE `items_articleId` = ' . $auctionId;
        $buyuser = $usersFunction->seachQurey($sql);
      }
    }else if(!empty($sell)){  // Áï¸Å Update
      if( $sell < $result1[0]['article_sell'] + 1){   // ÇöÀç ³«Âû °¡°Ýº¸´Ù ±Ý¾×ÀÌ ³·À¸¸é return
        echo '<script name="javascript"> window.alert("The current price is lower than the original price. Please re-enter."); history.go(-1);</script>';
      }else{
      // ********** À¯Àú ÀÔÂû & ³«Âû ÇöÈ²Á¤º¸ Update ( ³«Âû ) ********** //
      // ´©°¡ ³«ÂûÇß´ÂÁö Upload
        $sql = 'UPDATE `auctionItems` SET `items_sfb` = :items_sfb WHERE `items_articleId` = :items_articleId';
        $param = [
          'items_sfb'=>$userId,
          'items_articleId'=>$auctionId
        ];
        $usersFunction->uploadData($sql, $param);
        
      // ********** ¹°Ç° list ³«Âû Update ********** //
      // ¹°Ç°ÀÌ ³«ÂûµÆ´ÂÁö ¾ÈµÆ´ÂÁö Upload
        $sql = 'UPDATE `article` SET `article_end` = :article_end WHERE `article_id` = :article_id';
        $param = [
          'article_end'=>2,   // ³«ÂûµÆ´ÂÁö ¾ÈµÆ´ÂÁö È®ÀÎ. 1 = ³«Âûx,  2 = ³«Âûo
          'article_id'=>$auctionId
        ];
        $usersFunction->uploadData($sql, $param);
        
      // ********** UserDetail ³«Âû Update ********** //
        $sql = 'SELECT COUNT(`items_sfb`) FROM `auctionItems` WHERE `items_sfb`=\'' . $userId . '\'';
        $result2 = $usersFunction->seachQurey($sql);
        $sfbCnt = intval($result2[0][0]);   // ³«Âû °³¼ö
        
        $sql = 'UPDATE `userInfor` SET `infor_sfb` = :infor_sfb WHERE `user_id` = :user_id';
        $param = [
          'infor_sfb'=>$sfbCnt,
          'user_id'=>$userId
        ];
        $usersFunction->uploadData($sql, $param);
        
        header('location: ../php/index.php?id=' . $userId . '&sell=' . 2);
      }
    }
    ob_start();
    include __DIR__ .'/../templates/auctiondetail.html.php';
    $outString = ob_get_clean();
    
  }catch(PDOException $e){
    $outString='<p>Error : ' . $e->getMessage(). $e->getFile(). ' Line : ' . $e->getLine() .'</p>';
  }
  include __DIR__ .'/../templates/layout.html.php';
  