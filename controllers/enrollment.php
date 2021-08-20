<?php
  try{
    include_once __DIR__ .'/../includes/DbConnect.php'; // db ����
    include_once __DIR__ .'/../includes/userInformation.php';   // �α��� ��������
    include_once __DIR__ .'/../includes/Userfunction.php';  // SQL Class
    
  // Form �Է� ����
    $title = htmlspecialchars($_POST['article_title'], ENT_QUOTES, 'UTF-8');
    $discription = htmlspecialchars($_POST['article_discription'], ENT_QUOTES, 'UTF-8');
    $price = (int)$price2 = htmlspecialchars($_POST['article_price'], ENT_QUOTES, 'UTF-8');
    $category2 = htmlspecialchars($_POST['article_category'], ENT_QUOTES, 'UTF-8');
    $sell = (int)$sell2 = htmlspecialchars($_POST['article_sell'], ENT_QUOTES, 'UTF-8');
    
    if(!empty($discription)){  // Form �Է����� ������
      $fileSize = $_FILES['article_image']['size'];   // �̹��� Size
      define('MAX_IMAGE_SIZE',1000000);           // MAX ����ũ��
      
    // Image Size �˻�
      if(MAX_IMAGE_SIZE < $fileSize)
        echo '<script name="javascript"> window.alert("The image size is too large."); history.go(-1);</script>';
        
    // SQL Class ���� �� Category ������
      $usersFunction = new Userfunction($pdo);                      // SQL Class ����
      $category = $usersFunction->categorychange($category2);       // Category �з�
      
    /**
      Image �ӽ� ����
       Form ���� ������ �̹��� ������ 'tmp_name'�� ����� �ӽ������� �ҷ���
       ������ ���� �� DB�� �Է�
    */
      $uploaddir = __DIR__ .'/../auctionimages/';                   // �̹��� ������
      $uploadfile = $uploaddir . $_FILES['article_image']['name'];  // �̹��� �����̸�
      $filename = $_FILES['article_image']['tmp_name'];
      $imgfp = fopen($filename, 'rb');
      $imageblob = fread($imgfp, filesize($filename));
      fclose($imgfp);
      
  // Insert Part
       // *************************��ǰ��� Table Save ********************************************/
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
          'article_end'=>1      // 1  = �������, 2 = �������
      ];
      $usersFunction->uploadData($sql,$param);
            
       // ************************* ��Ź�ǰ ����&���� Table Save ********************************************/
              /** 
                ������ ��������� DB �ٽ� �����ͼ�
                auctionItems Table�� article.article_id�� �����Ͽ� Table����
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
      
    // ************************* userDetail ����( ��Ϲ�ǰ ��  ���� ) ********************************************/
        // ��� �������� ��ǰ�� Count
      $sql = 'SELECT COUNT(`user_id`) FROM `article` WHERE `user_id`=\'' . $_GET['id'] . '\' AND `article_end` = 1';
      $result = $usersFunction->seachQuery($sql);
      $itemCnt = intval($result[0][0]);   // ��ǰ �� ��� ����
      
        // UserDetail Update
      $sql = 'UPDATE `userInfor` SET `infor_auctionCnt` = :infor_auctionCnt WHERE `user_id` = :user_id';
      $param = [
        'infor_auctionCnt'=>$itemCnt,
        'user_id'=>$_GET['id']
      ];
      $usersFunction->uploadData($sql, $param);

      header('location: ../controllers/articleItems.php'.$user);
    }else{                     // ���� ��
      ob_start();
      include __DIR__ .'/../templates/enrollment.html.php';
      $outString = ob_get_clean();    
    }

  }catch(PDOEception $e){
    $outString='<p>Error : ' . $e->getMessage(). $e->getFile(). ' Line : ' . $e->getLine() .'</p>';
  }
  include __DIR__ .'/../templates/layout.html.php';