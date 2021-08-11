<?php
  try{
    include_once __DIR__ .'/../includes/DbConnect.php'; // db 연결
    include_once __DIR__ .'/../includes/userInformation.php';   // 로그인 유저정보
    include_once __DIR__ .'/../includes/Userfunction.php';  // SQL Class
    
  // Form 입력 정보
    $title = htmlspecialchars($_POST['article_title'], ENT_QUOTES, 'UTF-8');
    $discription = htmlspecialchars($_POST['article_discription'], ENT_QUOTES, 'UTF-8');
    $price = (int)$price2 = htmlspecialchars($_POST['article_price'], ENT_QUOTES, 'UTF-8');
    $category = htmlspecialchars($_POST['article_category'], ENT_QUOTES, 'UTF-8');
    $sell = (int)$sell2 = htmlspecialchars($_POST['article_sell'], ENT_QUOTES, 'UTF-8');
    
    if(!empty($discription)){  // Form 입력정보 있으면
      $uploaddir = __DIR__ .'/../auctionimages/';                   // 이미지 저장경로
      $uploadfile = $uploaddir . $_FILES['article_image']['name'];  // 이미지 저장이름
      define('MAX_IMAGE_SIZE',1000000);     // MAX 파일크기
      
      $filename = $_FILES['article_image']['tmp_name'];
      $imgfp = fopen($filename, 'rb');
      $imageblob = fread($imgfp, filesize($filename));
      fclose($imgfp);
    // 입력단    입력단 - 출력단 효율화 예정
      /*$sql = 'INSERT INTO `article` SET `user_id` = :user_id, `article_title` = :article_title, `article_image` = :article_image,
              `article_discription` = :article_discription, `article_price` = :article_price, `article_category` = :article_category,
              `article_sell` = :article_sell';
      $stmt = $pdo->prepare($sql);
      $stmt->bindValue(':user_id', $_GET['id']);
      $stmt->bindValue(':article_title', $title);
      $stmt->bindValue(':article_image', $imageblob, PDO::PARAM_LOB);
      $stmt->bindValue(':article_discription', $discription);
      $stmt->bindValue(':article_price', $price);
      $stmt->bindValue(':article_category', 1001);
      $stmt->bindValue(':article_sell', $sell);
      
      $stmt->execute();*/
    // 출력단
      $size = getimagesize($_FILES['article_image']['tmp_name']);   // 이미지 Size
      $type = $size['mime'];
      $sql = 'SELECT * FROM `article`';
      $stmt = $pdo->prepare($sql);
      $stmt->execute();
      $stmt->setFetchMode(PDO::FETCH_ASSOC);
      $array = $stmt->fetch();
      
      print_r($_FILES[article_image]);
      
      echo '<img src="data:image/bmp;base64,' . base64_encode( $array['article_image'] ) . '" />';  // 이미지 불러오기
    }else{                     // 없을 때
      ob_start();
      include __DIR__ .'/../templates/enrollment.html.php';
      $outString = ob_get_clean();    
    }

  }catch(PDOEception $e){
    $outString='<p>Error : ' . $e->getMessage(). $e->getFile(). ' Line : ' . $e->getLine() .'</p>';
  }
  include __DIR__ .'/../templates/layout.html.php';