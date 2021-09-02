<?php
  try{
    include_once __DIR__ .'/../includes/DbConnect.php';           // db 연결
    include_once __DIR__ .'/../includes/userInformation.php';     // 로그인 유저정보
    include_once __DIR__ .'/../includes/Userfunction.php';        // SQL Class
    
    $usersFunction = new Userfunction($pdo);                      // SQL Class 생성
    $cate = htmlspecialchars($_GET['cate'], ENT_QUOTES, 'UTF-8'); // Category 확인

    $title = $cate . ' Page';
  // ***************** Category 분류 Number ( Select ) ******************* //
    $categoryNo = $usersFunction->seachQuery('SELECT `num` FROM `category` WHERE `categ` = \'' . $cate . '\'');
    
  // ***************** 지정한 Category 물건만 표기( Select ) ******************* //    
    $result = $usersFunction->seachQuery('SELECT * FROM `article` WHERE `article_category` = ' . (int)$categoryNo[0]['num']);
    
    ob_start();
    include __DIR__ . '/../templates/articleItems.html.php';
    $outString = ob_get_clean();
  
  }catch(PDOException $e){
  // 임시
    $outString='<p>Error : ' . $e->getMessage(). $e->getFile(). ' Line : ' . $e->getLine() .'</p>';
  }
  
  include __DIR__ .'/../templates/layout.html.php';
