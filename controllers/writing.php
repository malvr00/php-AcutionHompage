<?php
try{
  include_once __DIR__ .'/../includes/DbConnect.php'; // db ����
  $title = 'User writing';
  
// ���� �Խñ� query
  $sql = 'SELECT * FROM `writing`';
  $result = $pdo->query($sql);

// Form ��������
  ob_start();
  include __DIR__ .'/../templates/writingForm.html.php';
  $outString = ob_get_clean();
  
}catch(PDOException $e){
  // �ӽ�
  $outString='<p>Error : ' . $e->getMessage(). $e->getFile(). ' Line : ' . $e->getLine() .'</p>';
}
include __DIR__ .'/../templates/layout.html.php';