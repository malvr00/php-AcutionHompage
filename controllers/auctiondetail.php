<?php
  try{
    include_once __DIR__ .'/../includes/DbConnect.php';         // db ����
    include_once __DIR__ .'/../includes/userInformation.php';   // �α��� ��������
    include_once __DIR__ .'/../includes/Userfunction.php';      // SQL Class
    
    $userId = $_GET['?id'];                   // user Id
    $auctionId = $_GET['auction'];            // auction id
    $usersFunction = new Userfunction($pdo);  // SQL Class ����
    
  // ********** SQL Query Select ( Ŭ���� ��ǰ Seach ) ********** /
    $sql = 'SELECT * FROM `article` WHERE `article_id` = ' . $auctionId;
  // ******��ǰ����� ���� ����****** /
    $result1 = $usersFunction->seachQurey($sql);
    
  // ********** ��Ź�ǰ ����&���� Table ********** /
    $sql = 'SELECT * FROM `auctionItems` WHERE `items_articleId` = ' . $auctionId;
  // ********** ��� ���� & ���� ��Ȳ���� **********/
    $buyuser = $usersFunction->seachQurey($sql);
  
  // ���� ���� ����
    $price = (int)$price2 = htmlspecialchars($_POST['items_price'], ENT_QUOTES, 'UTF-8');    // ���� ���� ����
    $sell = (int)$sell2 = htmlspecialchars($_POST['article_sell'], ENT_QUOTES, 'UTF-8');    // ���� ���� ����
    
    if(!empty($price)){
      if($price < $buyuser[0]['items_price'] +1){   // ���� ���� ���ݺ��� �ݾ��� ������ return
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