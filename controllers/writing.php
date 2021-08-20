<?php
try{
  include_once __DIR__ .'/../includes/DbConnect.php';         // db ����
  include_once __DIR__ .'/../includes/userInformation.php';   // �α��� ��������
  include_once __DIR__ .'/../includes/Userfunction.php';      // SQL Class
  $title = 'User writing';
  
  $usersFunction = new Userfunction($pdo);  // SQL Class ����
  $write = htmlspecialchars($_POST['write'], ENT_QUOTES, 'UTF-8'); // Button Ȯ�ο�
  
  if(!empty($write)){
  // �Խñ� �ۼ�Form �̵�
    ob_start();
    include __DIR__ .'/../templates/writingForm2.html.php';
    $outString = ob_get_clean();
  }else{
    // ���� �Խñ� query
    $sql = 'SELECT * FROM `writing`';
    $result = $usersFunction->seachQuery($sql);
    
  // Form ��������
    ob_start();
    include __DIR__ .'/../templates/writingForm.html.php';
    $outString = ob_get_clean();
  }
}catch(PDOException $e){
  // �ӽ�
  $outString='<p>Error : ' . $e->getMessage(). $e->getFile(). ' Line : ' . $e->getLine() .'</p>';
}
include __DIR__ .'/../templates/layout.html.php';