<?php
 try{
  include_once __DIR__ .'/../includes/DbConnect.php';         // db ����
  include_once __DIR__ .'/../includes/userInformation.php';   // �α��� ��������
  include_once __DIR__ .'/../includes/Userfunction.php';      // SQL Class
  
  $usersFunction = new Userfunction($pdo);  // SQL Class ����
  $userid = htmlspecialchars($_GET['id'], ENT_QUOTES, 'UTF-8');                                // �α��� ����
  $pageid = intval(htmlspecialchars($_GET['pageid'], ENT_QUOTES, 'UTF-8'));                    // �Խñ� id
  $comment_discription = htmlspecialchars($_POST['comment_discription'], ENT_QUOTES, 'UTF-8'); // ��۳���
  
// ************** �Խñ� ����߰� (Insert) ************** //
  $sql = 'INSERT INTO `comment` SET `writing_id` = :writing_id, `user_id` = :user_id, `discription` = :discription';
  $param = [
    'writing_id'=>$pageid,
    'user_id'=>$userid,
    'discription'=>$comment_discription
  ];
  $usersFunction->uploadData($sql, $param);

// ��� �߰� �� �Խñ۷� �̵�
  header('location: writingView.php' . $user . '&pageid=' . $pageid);
  
 }catch(PDOException $e){
  $outString='<p>Error : ' . $e->getMessage(). $e->getFile(). ' Line : ' . $e->getLine() .'</p>';
 }