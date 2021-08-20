<?php
  try{
    include_once __DIR__ .'/../includes/DbConnect.php';         // db ����
    include_once __DIR__ .'/../includes/userInformation.php';   // �α��� ��������
    include_once __DIR__ .'/../includes/Userfunction.php';      // SQL Class
    
    $check = htmlspecialchars($_POST['check'], ENT_QUOTES, 'UTF-8');  // ���� ��ư Click Ȯ��
    
    if(!empty($check)){
      $payPoint = intval(htmlspecialchars($_POST['pay'], ENT_QUOTES, 'UTF-8'));  // �����ݾ� Get
      $usersFunction = new Userfunction($pdo);          // SQL Class ����
      
    // **************** ���� �������ִ� point �ҷ��� **************** //
      $sql = 'SELECT `infor_point` FROM `userInfor` WHERE `user_id` = \'' . $_GET['id'] . '\'';
      $userPoint = $usersFunction->seachQuery($sql);
    // **************** ���� point Update **************** //
      $totalPoint = $payPoint + (int)$userPoint[0]['infor_point'];
      $sql = 'UPDATE `userInfor` SET `infor_point` = :infor_point WHERE `user_id` = :user_id';
      $param = [
        'infor_point'=>$totalPoint,
        'user_id'=>$_GET['id']
      ];
      $usersFunction->uploadData($sql, $param);
      
      header('location: userdetail.php?id=' . $_GET['id']);
    }else{
      ob_start();
      include __DIR__ . '/../templates/charging.html.php';
      $outString = ob_get_clean();
    }    
  }catch(PDOException $e){
    $outString='<p>Error : ' . $e->getMessage(). $e->getFile(). ' Line : ' . $e->getLine() .'</p>';
  }
  include __DIR__ .'/../templates/layout.html.php';