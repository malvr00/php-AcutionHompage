<?php
  try{
    include_once __DIR__ .'/../includes/DbConnect.php'; // db ����
    include_once __DIR__ .'/../includes/userInformation.php';   // �α��� ��������
    
    $title = Auction;

 // home ���
  //ob_start();
    $outString = 'mainpage2';
  
  }catch(PDOException $e){
  // �ӽ�
    $outString='<p>Error : ' . $e->getMessage(). $e->getFile(). ' Line : ' . $e->getLine() .'</p>';
  }
  
  include __DIR__ .'/../templates/layout.html.php';