<?php
  try{
    include_once __DIR__ .'/../includes/DbConnect.php';         // db ����
    include_once __DIR__ .'/../includes/userInformation.php';   // �α��� ��������
    include_once __DIR__ .'/../includes/Userfunction.php';      // SQL Class
    
    $usersFunction = new Userfunction($pdo);                    // SQL Class ����
    
    $title = Auction;
    
    if($_GET['sell'] == '2'){
      echo '<script name="javascript"> window.alert("congratulations. successful bid!!!!!");</script>';
    }
    
  // ********** ��ϵ� ��ǰ Seach ********** //
    $result = $usersFunction->seachQuery('SELECT * FROM `article`');
     
    ob_start();
    include __DIR__ .'/../templates/articleItems.html.php';
    $outString = ob_get_clean();
  
  }catch(PDOException $e){
  // �ӽ�
    $outString='<p>Error : ' . $e->getMessage(). $e->getFile(). ' Line : ' . $e->getLine() .'</p>';
  }
  
  include __DIR__ .'/../templates/layout.html.php';