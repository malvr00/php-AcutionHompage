<?php
  try{
    include_once __DIR__ .'/../includes/DbConnect.php'; // db ����
    include_once __DIR__ .'/../includes/userInformation.php';   // �α��� ��������
    
    $title = Auction;
    
    if($_GET['sell'] == '2'){
      echo '<script name="javascript"> window.alert("congratulations. successful bid!!!!!");</script>';
    }
 // home ���
  //ob_start();
    $outString = 'mainpage2';
  
  }catch(PDOException $e){
  // �ӽ�
    $outString='<p>Error : ' . $e->getMessage(). $e->getFile(). ' Line : ' . $e->getLine() .'</p>';
  }
  
  include __DIR__ .'/../templates/layout.html.php';