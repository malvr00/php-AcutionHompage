<?php
  try{
    include_once __DIR__ .'/../includes/DbConnect.php';         // db ����
    include_once __DIR__ .'/../includes/userInformation.php';   // �α��� ��������
    include_once __DIR__ .'/../includes/Userfunction.php';      // SQL Class
    
    $userId = $_GET['?id'];                   // user Id
    $auctionId = $_GET['auction'];            // auction id
    $usersFunction = new Userfunction($pdo);  // SQL Class ����
    
  // SQL Query Select ( Ŭ���� ��ǰ Seach )  
    $sql = 'SELECT * FROM `article` WHERE `article_id` = ' . $auctionId;
    $result = $usersFunction->seachQurey($sql);

    ob_start();
    include __DIR__ .'/../templates/auctiondetail.html.php';
    $outString = ob_get_clean();
    
  }catch(PDOException $e){
    $outString='<p>Error : ' . $e->getMessage(). $e->getFile(). ' Line : ' . $e->getLine() .'</p>';
  }
  include __DIR__ .'/../templates/layout.html.php';