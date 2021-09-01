<?php
  try{
    include_once __DIR__ .'/../includes/DbConnect.php';           // db 연결
    include_once __DIR__ .'/../includes/userInformation.php';     // 로그인 유저정보
    include_once __DIR__ .'/../includes/Userfunction.php';        // SQL Class
    
    $usersFunction = new Userfunction($pdo);                      // SQL Class 생성
    $userid = htmlspecialchars($_GET['id'], ENT_QUOTES, 'UTF-8'); // 로그인 유저
    $deleteUser = htmlspecialchars($_POST['delete'], ENT_QUOTES, 'UTF-8');  // 회원탈퇴 확인

    if($deleteUser == 'YES'){
    // ************** 유저정보 삭제 (Delete) ************** //
      $sql = 'DELETE FROM `user` WHERE `user_id` = :user_id';
      $param = [
        'user_id'=>$userid
      ];
      $usersFunction->uploadData($sql,$param);
      
    // ************** 유저상세정보 삭제 (Delete) ************** // 
      $sql = 'DELETE FROM `userInfor` WHERE `user_id` = :user_id';
      $param = [
        'user_id'=>$userid
      ];
      $usersFunction->uploadData($sql,$param);
      
    // ************** 유저게시글 삭제 (Delete) ************** // 
      $sql = 'DELETE FROM `writing` WHERE `user_id` = :user_id';
      $param = [
        'user_id'=>$userid
      ];
      $usersFunction->uploadData($sql,$param);
      
    // ************** 유저댓글 삭제 (Delete) ************** // 
      $sql = 'DELETE FROM `comment` WHERE `user_id` = :user_id';
      $param = [
        'user_id'=>$userid
      ];
      $usersFunction->uploadData($sql,$param);
      
    // ************** 등록한 물품이 있는지 확인 ( Select ) ************** //
      $sql = 'SELECT `article_id` FROM `article` WHERE `user_id` = \'' . $userid . '\'';
      $result = $usersFunction->seachQuery($sql);
      if($result[0]['article_id'] != ""){
       // ************** 등록한 물품삭제 ( Delete ) ************** //
        foreach($result as $row):
          $sql = 'DELETE FROM `auctionItems` WHERE `items_articleId`=:items_articleId';
          $param = [
            'items_articleId' => $row['article_id']
          ];
          $usersFunction->uploadData($sql,$param);
        // ************** 등록한 물품 입찰현황 삭제 ( Delete ) ************** //
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
  // 임시
    $outString='<p>Error : ' . $e->getMessage(). $e->getFile(). ' Line : ' . $e->getLine() .'</p>';
  }
?>