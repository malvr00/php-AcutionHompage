<?php
try{
  include_once __DIR__ .'/../includes/DbConnect.php';         // db ����
  include_once __DIR__ .'/../includes/userInformation.php';   // �α��� ��������
  include_once __DIR__ .'/../includes/Userfunction.php';      // SQL Class
  $title = 'User writing';
  
  $usersFunction = new Userfunction($pdo);  // SQL Class ����
  $write = htmlspecialchars($_POST['write'], ENT_QUOTES, 'UTF-8'); // Button Ȯ�ο�
  $userid = $_GET['id'];      // �α��� ����
  
  if(!empty($write)){
  // �Խñ� �ۼ�Form �̵�
    ob_start();
    include __DIR__ .'/../templates/writingForm2.html.php';
    $outString = ob_get_clean();
  }else{
    // ���� ������ �ʼ�
    if(isset($_GET['page'])){
      $page = htmlspecialchars($_GET['page'], ENT_QUOTES, 'UTF-8');
    }else{
      $page = 1;  // ������ 1
    }
    
    $listpage = 10;                                   // �� �������� �Խñ� 10�� �� ��Ÿ��
    $sql = 'SELECT COUNT(`id`) FROM `writing`';
    $total_cnt = $usersFunction->seachQuery($sql);    // �Խñ� �ۼ� page ��
    $total_page = ceil($total_cnt[0][0]/$listpage);   // ������ �� �ʼ�
    $nowpage = $listpage * ($page - 1);               // Table row ��°
    
  // ������ �� ��
    $total_block = ceil($total_page/$listpage);       // �������� 10���� 1������
    $block = ceil($page/$listpage);                   // �� ��° ���� �ִ���
    $first = (($block-1) * $listpage) + 1;            // ù ��° ������
    $last = $block * $listpage;                       // ������ ������

  // ******************** ���� �Խñ� Select Limit  ( 10���� �ҷ���) ******************** //
    $sql = 'SELECT * FROM `writing` limit ' . $nowpage . ', ' . $listpage;
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