<?php
 try{
  include_once __DIR__ .'/../includes/DbConnect.php';         // db ����
  include_once __DIR__ .'/../includes/userInformation.php';   // �α��� ��������
  include_once __DIR__ .'/../includes/Userfunction.php';      // SQL Class
  
  $usersFunction = new Userfunction($pdo);  // SQL Class ����
  $userid = htmlspecialchars($_GET['id'], ENT_QUOTES, 'UTF-8');              // �α��� ����
  $pageid = intval(htmlspecialchars($_GET['pageid'], ENT_QUOTES, 'UTF-8'));  // �Խñ� id
  $modifyCheck = htmlspecialchars($_POST['modify'], ENT_QUOTES, 'UTF-8');    // ������ư Ŭ��üũ
  
  if(!empty($modifyCheck)){   // �Խñ� ���� ��
    $modify_title = htmlspecialchars($_POST['modify_title'], ENT_QUOTES, 'UTF-8');              // ���� ����
    $modify_discription = htmlspecialchars($_POST['modify_discription'], ENT_QUOTES, 'UTF-8');  // ���� ����
    
 // *************** ������ �Խñ� ���ε� ( Update ) *************** //     
    $sql = 'UPDATE `writing` SET `title` = :title, `discription` = :discription WHERE `id`= :id';
    $param = [
      'title'=>$modify_title,
      'discription'=>$modify_discription,
      'id'=>$pageid
    ];
    $usersFunction->uploadData($sql, $param);
    
    header('location: writingView.php' . $user . '&pageid=' . $pageid);
  }else{    // �Խñ� ���� ��
 // *************** ���� �� �Խñ۳��� ( Select ) *************** //
  // Get���� �j�� pageid�� ã��
    $sql = 'SELECT `user_id`, `title`, `discription` FROM `writing` WHERE `id` = ' . $pageid;
    $view = $usersFunction->seachQuery($sql);     // �� �ۼ��� ����
    
    ob_start();
    include __DIR__ .'/../templates/writingModify.html.php';
    $outString = ob_get_clean();
  }
  
 }catch(PDOException $e){
  $outString='<p>Error : ' . $e->getMessage(). $e->getFile(). ' Line : ' . $e->getLine() .'</p>';
 }
 
 include __DIR__ .'/../templates/layout.html.php';