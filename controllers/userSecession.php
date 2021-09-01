<?php
  try{
    include_once __DIR__ .'/../includes/DbConnect.php';           // db ����
    include_once __DIR__ .'/../includes/userInformation.php';     // �α��� ��������
    include_once __DIR__ .'/../includes/Userfunction.php';        // SQL Class
    
    $usersFunction = new Userfunction($pdo);                      // SQL Class ����
    $userid = htmlspecialchars($_GET['id'], ENT_QUOTES, 'UTF-8'); // �α��� ����
    $deleteUser = htmlspecialchars($_POST['delete'], ENT_QUOTES, 'UTF-8');  // ȸ��Ż�� Ȯ��

    if($deleteUser == 'YES'){
    // ************** �������� ���� (Delete) ************** //
      $sql = 'DELETE FROM `user` WHERE `user_id` = :user_id';
      $param = [
        'user_id'=>$userid
      ];
      $usersFunction->uploadData($sql,$param);
      
    // ************** ���������� ���� (Delete) ************** // 
      $sql = 'DELETE FROM `userInfor` WHERE `user_id` = :user_id';
      $param = [
        'user_id'=>$userid
      ];
      $usersFunction->uploadData($sql,$param);
      
    // ************** �����Խñ� ���� (Delete) ************** // 
      $sql = 'DELETE FROM `writing` WHERE `user_id` = :user_id';
      $param = [
        'user_id'=>$userid
      ];
      $usersFunction->uploadData($sql,$param);
      
    // ************** ������� ���� (Delete) ************** // 
      $sql = 'DELETE FROM `comment` WHERE `user_id` = :user_id';
      $param = [
        'user_id'=>$userid
      ];
      $usersFunction->uploadData($sql,$param);
      
    // ************** ����� ��ǰ�� �ִ��� Ȯ�� ( Select ) ************** //
      $sql = 'SELECT `article_id` FROM `article` WHERE `user_id` = \'' . $userid . '\'';
      $result = $usersFunction->seachQuery($sql);
      if($result[0]['article_id'] != ""){
       // ************** ����� ��ǰ���� ( Delete ) ************** //
        foreach($result as $row):
          $sql = 'DELETE FROM `auctionItems` WHERE `items_articleId`=:items_articleId';
          $param = [
            'items_articleId' => $row['article_id']
          ];
          $usersFunction->uploadData($sql,$param);
        // ************** ����� ��ǰ ������Ȳ ���� ( Delete ) ************** //
          $sql = 'DELETE FROM `article` WHERE `user_id` = :user_id';
          $param = [
            'user_id'=>$userid
          ];
          $usersFunction->uploadData($sql,$param);
        endforeach;
        header('location:../php/index.php');
      }else{
        header('location:../php/index.php');
      }
    }else{
      header('location:userdetail.php' . $user);
    }
    
  
  //header('location:../php/index.php');
  }catch(PDOException $e){
  // �ӽ�
    $outString='<p>Error : ' . $e->getMessage(). $e->getFile(). ' Line : ' . $e->getLine() .'</p>';
  }
?>