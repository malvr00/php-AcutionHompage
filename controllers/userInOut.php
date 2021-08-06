<?php
 try{
  include_once __DIR__ .'/../includes/DbConnect.php'; // DB 연결
  include_once __DIR__ .'/../includes/Userfunction.php';  // SQL Class
  
  $usersFunction = new Userfunction($pdo);  // SQL Class 생성
  
  $user_id = htmlspecialchars($_POST['user_id'], ENT_QUOTES, 'UTF-8');                // 입력받은 user ID
  $user_password = htmlspecialchars($_POST['user_password'], ENT_QUOTES, 'UTF-8');    // 입력받은 user password
  $user_password2 = htmlspecialchars($_POST['user_password2'], ENT_QUOTES, 'UTF-8');  // 입력받은 user password 확인용
    
// 회원가입 로그인 구분. 
// 1 = 회원가입, 2 = 로그인
  if($_GET['signtype'] == '1'){   // 회원가입
    if(!empty($user_id)){
     // 회원가입 자료입력 후 처리
      $row = $usersFunction->seachUser('SELECT `user_id` FROM `user`');  // User ID 반환
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
  }else if($_GET['signtype'] == '2'){   // 로그인
    if(!empty($user_id)){
      // 로그인 자료입력 후 처리
      $row = $usersFunction->seachUser('SELECT * FROM `user`');  // User들 정보 반환
      foreach($row as $users){
        if($users['user_id'] != $user_id){
         // 아이디 확인
          echo '<script name="javascript"> window.alert("Please re-enter your ID."); history.go(-1);</script>';
        }else if($users['user_password'] != $user_password){
         // 비밀번호 확인
          echo '<script name="javascript"> window.alert("The password is wrong. Please re-enter."); history.go(-1);</script>';
        }else if($user_password != $user_password2){
         // 비밀번호 재확인
          echo '<script name="javascript"> window.alert("Please enter the duplicate password again."); history.go(-1);</script>';
        }else{
          header('location: ../php/index.php?id='.$user_id); 
        }
      }
    }else{
      // 로그인 자료입력 전 처리
      $button = 'Log In';
      $title = 'Log In';
      
    // 버퍼 저장
      ob_start();
      include __DIR__ .'/../templates/userInForm.html.php';
      $outString = ob_get_clean();
    }
  }
 }catch(PDOException $e){
  $outString='<p>Error : ' . $e->getMessage(). $e->getFile(). ' Line : ' . $e->getLine() .'</p>';
 }
 include __DIR__ .'/../templates/userInformation.html.php';