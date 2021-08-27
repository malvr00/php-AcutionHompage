<?php
 try{
  include_once __DIR__ .'/../includes/DbConnect.php';         // db ����
  include_once __DIR__ .'/../includes/userInformation.php';   // �α��� ��������
  include_once __DIR__ .'/../includes/Userfunction.php';      // SQL Class
  
  $usersFunction = new Userfunction($pdo);  // SQL Class ����
  $userid = htmlspecialchars($_GET['id'], ENT_QUOTES, 'UTF-8');              // �α��� ���� id
  $pageid = intval(htmlspecialchars($_GET['pageid'], ENT_QUOTES, 'UTF-8'));  // �Խñ� id

// *************** Ŭ���� �Խñ۳��� ( Select ) *************** //
  // Get���� �j�� pageid�� ã��
  $sql = 'SELECT `user_id`, `title`, `discription` FROM `writing` WHERE `id` = ' . $pageid;
  $view = $usersFunction->seachQuery($sql);     // �� �ۼ��� ����
  
 // �� �ۼ��ڸ� ������ư ���̵��� ��������
  $userConfirm = ($userid == $view[0]['user_id'])?true:false;     

// *************** �Խñ� ������� ( Select ) *************** //
  $sql = 'SELECT * FROM `comment` WHERE `writing_id` = ' . $pageid;
  $comments = $usersFunction->seachQuery($sql);

  ob_start();
  include __DIR__ .'/../templates/writingView.html.php';
  $outString = ob_get_clean();
  
 }catch(PDOException $e){
  $outString='<p>Error : ' . $e->getMessage(). $e->getFile(). ' Line : ' . $e->getLine() .'</p>';
 }
 include __DIR__ .'/../templates/layout.html.php';
 