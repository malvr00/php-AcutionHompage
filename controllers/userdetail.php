<?php
  try{
    include_once __DIR__ .'/../includes/DbConnect.php';         // db ����
    include_once __DIR__ .'/../includes/userInformation.php';   // �α��� ��������
    include_once __DIR__ .'/../includes/Userfunction.php';      // SQL Class
    
    $usersFunction = new Userfunction($pdo);  // SQL Class ����
    $userid = $_GET['id'];                    // user id
    
  // ************* ���������� SELECT ************* //
    $sql = 'SELECT * FROM `userInfor` WHERE `user_id`=\'' . $userid . '\'';
    $result = $usersFunction->seachQurey($sql);
    
    ob_start();
    include __DIR__ .'/../templates/userdetail.html.php';
    $outString = ob_get_clean();
    
  }catch(PDOException $e){
    $outString='<p>Error : ' . $e->getMessage(). $e->getFile(). ' Line : ' . $e->getLine() .'</p>';
  }
  
  include __DIR__ .'/../templates/layout.html.php';