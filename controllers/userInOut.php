<?php
 try{
  include_once __DIR__ .'/../includes/DbConnect.php'; // DB 연결
  include_once __DIR__ .'/../includes/Userfunction.php';  // SQL Class
  
  $usersFunction = new Userfunction($pdo);  // SQL Class 생성
  
// 회원가입 로그인 구분. 
// 1 = 회원가입, 2 = 로그인
  if($_GET['signtype'] == '1'){
    $user_id = htmlspecialchars($_POST['user_id'], ENT_QUOTES, 'UTF-8');
    $user_password = htmlspecialchars($_POST['user_password'], ENT_QUOTES, 'UTF-8');
    $user_password2 = htmlspecialchars($_POST['user_password2'], ENT_QUOTES, 'UTF-8');
    
    if(!empty($user_id)){
     // 회원가입 자료입력 후 처리
      $row = $usersFunction->seachUserId('SELECT `user_id` FROM `user`');  // User ID 반환
      foreach($row as $users){
       // 이미 가입되있는 중복아이디 체크    
        if($users['user_id'] == $user_id){
          echo '<script name="javascript"> window.alert("Please enter the duplicate ID again."); history.go(-1);</script>';
        }
      }
      
      if($user_password != $user_password2){
       // 비밀번호 처음입력한 값과 같은지 체크
        echo '<script name="javascript"> window.alert("Please enter the duplicate password again."); history.go(-1);</script>';
      }else{
       // 비밀번호 같으면 Insert (DB에 저장)
        $param = [
            'user_id'=>$user_id,
            'user_password'=>$user_password
        ];
       // Insert 
        $usersFunction->insertData('INSERT INTO `user` SET `user_id` = :user_id,`user_password` = :user_password',$param);
        header('location: ../php/index.php');
      }
    }else{
     // 회원가입 자료입력 전 처리
      $button = 'Join';
      $title = 'Sign Up';
     // 버퍼 저장
      ob_start();
      include __DIR__ .'/../templates/userInForm.html.php';
      $outString = ob_get_clean();
    }
  }else{
    /*if(isset(htmlspecialchars($_POST['user_id'], ENT_QUOTES, 'UTF-8')){
      // 로그인 자료입력 후 처리
    }else{
      // 로그인 자료입력 전 처리
      $button = 'Log In';
      $title = 'Log In';
      ob_start();
      include __DIR__ .'/../templates/userInForm.html.php';
      $outString = ob_get_clean();
    }*/
  }
 }catch(PDOException $e){
  $outString='<p>Error : ' . $e->getMessage(). $e->getFile(). ' Line : ' . $e->getLine() .'</p>';
 }
 include __DIR__ .'/../templates/userInformation.html.php';