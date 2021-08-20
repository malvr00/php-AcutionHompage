<?php
  try{
    include_once __DIR__ .'/../includes/DbConnect.php'; // db 연결
    include_once __DIR__ .'/../includes/userInformation.php';   // 로그인 유저정보
    include_once __DIR__ .'/../includes/Userfunction.php';  // SQL Class
    
  // Form 입력 정보
    $title = htmlspecialchars($_POST['article_title'], ENT_QUOTES, 'UTF-8');
    $discription = htmlspecialchars($_POST['article_discription'], ENT_QUOTES, 'UTF-8');
    $price = (int)$price2 = htmlspecialchars($_POST['article_price'], ENT_QUOTES, 'UTF-8');
    $category2 = htmlspecialchars($_POST['article_category'], ENT_QUOTES, 'UTF-8');
    $sell = (int)$sell2 = htmlspecialchars($_POST['article_sell'], ENT_QUOTES, 'UTF-8');
    
    if(!empty($discription)){  // Form 입력정보 있으면
      $fileSize = $_FILES['article_image']['size'];   // 이미지 Size
      define('MAX_IMAGE_SIZE',1000000);           // MAX 파일크기
      
    // Image Size 검사
      if(MAX_IMAGE_SIZE < $fileSize)
        echo '<script name="javascript"> window.alert("The image size is too large."); history.go(-1);</script>';
        
    // SQL Class 생성 및 Category 재정의
      $usersFunction = new Userfunction($pdo);                      // SQL Class 생성
      $category = $usersFunction->categorychange($category2);       // Category 분류
      
    /**
      Image 임시 저장
       Form 에서 전송한 이미지 파일을 'tmp_name'에 저장된 임시파일을 불러와
       변수에 저장 후 DB에 입력
    */
      $uploaddir = __DIR__ .'/../auctionimages/';                   // 이미지 저장경로
      $uploadfile = $uploaddir . $_FILES['article_image']['name'];  // 이미지 저장이름
      $filename = $_FILES['article_image']['tmp_name'];
      $imgfp = fopen($filename, 'rb');
      $imageblob = fread($imgfp, filesize($filename));
      fclose($imgfp);
      
  // Insert Part
       // *************************물품등록 Table Save ********************************************/
      $sql = 'INSERT INTO `article` SET `user_id` = :user_id, `article_title` = :article_title, `article_image` = :article_image,
              `article_discription` = :article_discription, `article_price` = :article_price, `article_category` = :article_category,
              `article_sell` = :article_sell, `article_end` = :article_end';
      $param = [
          'user_id'=>$_GET['id'], 
          'article_title'=>$title, 
          'article_image'=>$imageblob, 
          'article_discription'=>$discription,
          'article_price'=>$price,
          'article_category'=>$category, 
          'article_sell'=>$sell,
          'article_end'=>1      // 1  = 경매진행, 2 = 경매종료
      ];
      $usersFunction->uploadData($sql,$param);
            
       // ************************* 경매물품 입찰&낙찰 Table Save ********************************************/
              /** 
                위에서 방금저장한 DB 다시 가져와서
                auctionItems Table에 article.article_id를 저장하여 Table연동
              */
      $sql = 'SELECT * FROM `article` WHERE `user_id` = \'' . $_GET['id'] . '\' ORDER BY `article_id` DESC';
      $result = $usersFunction->seachQuery($sql);
      
      $sql = 'INSERT INTO `auctionItems` SET `items_articleId` = :items_articleId, `user_id` = :user_id,  
              `items_price` = :items_price';
      $param = [
          'items_articleId'=>$result[0][1],
          'user_id'=>$_GET['id'],
          'items_price'=>$result[0][5]
      ];
      $usersFunction->uploadData($sql, $param);
      
    // ************************* userDetail 수정( 등록물품 수  증가 ) ********************************************/
        // 경매 진행중인 물품만 Count
      $sql = 'SELECT COUNT(`user_id`) FROM `article` WHERE `user_id`=\'' . $_GET['id'] . '\' AND `article_end` = 1';
      $result = $usersFunction->seachQuery($sql);
      $itemCnt = intval($result[0][0]);   // 물품 총 등록 개수
      
        // UserDetail Update
      $sql = 'UPDATE `userInfor` SET `infor_auctionCnt` = :infor_auctionCnt WHERE `user_id` = :user_id';
      $param = [
        'infor_auctionCnt'=>$itemCnt,
        'user_id'=>$_GET['id']
      ];
      $usersFunction->uploadData($sql, $param);

      header('location: ../controllers/articleItems.php'.$user);
    }else{                     // 없을 때
      ob_start();
      include __DIR__ .'/../templates/enrollment.html.php';
      $outString = ob_get_clean();    
    }

  }catch(PDOEception $e){
    $outString='<p>Error : ' . $e->getMessage(). $e->getFile(). ' Line : ' . $e->getLine() .'</p>';
  }
  include __DIR__ .'/../templates/layout.html.php';