<?php
  try{
    include_once __DIR__ .'/../includes/DbConnect.php'; // db ����
    include_once __DIR__ .'/../includes/userInformation.php';   // �α��� ��������
    include_once __DIR__ .'/../includes/Userfunction.php';  // SQL Class
    
  // Form �Է� ����
    $title = htmlspecialchars($_POST['article_title'], ENT_QUOTES, 'UTF-8');
    $discription = htmlspecialchars($_POST['article_discription'], ENT_QUOTES, 'UTF-8');
    $price = (int)$price2 = htmlspecialchars($_POST['article_price'], ENT_QUOTES, 'UTF-8');
    $category = htmlspecialchars($_POST['article_category'], ENT_QUOTES, 'UTF-8');
    $sell = (int)$sell2 = htmlspecialchars($_POST['article_sell'], ENT_QUOTES, 'UTF-8');
    
    if(!empty($discription)){  // Form �Է����� ������
      $uploaddir = __DIR__ .'/../auctionimages/';                   // �̹��� ������
      $uploadfile = $uploaddir . $_FILES['article_image']['name'];  // �̹��� �����̸�
      define('MAX_IMAGE_SIZE',1000000);     // MAX ����ũ��
      
      $filename = $_FILES['article_image']['tmp_name'];
      $imgfp = fopen($filename, 'rb');
      $imageblob = fread($imgfp, filesize($filename));
      fclose($imgfp);
    // �Է´�    �Է´� - ��´� ȿ��ȭ ����
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
    // ��´�
      $size = getimagesize($_FILES['article_image']['tmp_name']);   // �̹��� Size
      $type = $size['mime'];
      $sql = 'SELECT * FROM `article`';
      $stmt = $pdo->prepare($sql);
      $stmt->execute();
      $stmt->setFetchMode(PDO::FETCH_ASSOC);
      $array = $stmt->fetch();
      
      print_r($_FILES[article_image]);
      
      echo '<img src="data:image/bmp;base64,' . base64_encode( $array['article_image'] ) . '" />';  // �̹��� �ҷ�����
    }else{                     // ���� ��
      ob_start();
      include __DIR__ .'/../templates/enrollment.html.php';
      $outString = ob_get_clean();    
    }

  }catch(PDOEception $e){
    $outString='<p>Error : ' . $e->getMessage(). $e->getFile(). ' Line : ' . $e->getLine() .'</p>';
  }
  include __DIR__ .'/../templates/layout.html.php';