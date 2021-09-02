<?php
  try{
    include_once __DIR__ .'/../includes/DbConnect.php';           // db ����
    include_once __DIR__ .'/../includes/userInformation.php';     // �α��� ��������
    include_once __DIR__ .'/../includes/Userfunction.php';        // SQL Class
    
    $usersFunction = new Userfunction($pdo);                      // SQL Class ����
    $cate = htmlspecialchars($_GET['cate'], ENT_QUOTES, 'UTF-8'); // Category Ȯ��

    $title = $cate . ' Page';
  // ***************** Category �з� Number ( Select ) ******************* //
    $categoryNo = $usersFunction->seachQuery('SELECT `num` FROM `category` WHERE `categ` = \'' . $cate . '\'');
    
  // ***************** ������ Category ���Ǹ� ǥ��( Select ) ******************* //    
    $result = $usersFunction->seachQuery('SELECT * FROM `article` WHERE `article_category` = ' . (int)$categoryNo[0]['num']);
    
    ob_start();
    include __DIR__ . '/../templates/articleItems.html.php';
    $outString = ob_get_clean();
  
  }catch(PDOException $e){
  // �ӽ�
    $outString='<p>Error : ' . $e->getMessage(). $e->getFile(). ' Line : ' . $e->getLine() .'</p>';
  }
  
  include __DIR__ .'/../templates/layout.html.php';
