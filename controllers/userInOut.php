<?php
 try{
  include_once __DIR__ .'/../includes/DbConnect.php'; // DB ����
  include_once __DIR__ .'/../includes/Userfunction.php';  // SQL Class
  
  $usersFunction = new Userfunction($pdo);  // SQL Class ����
  
  $user_id = htmlspecialchars($_POST['user_id'], ENT_QUOTES, 'UTF-8');                // �Է¹��� user ID
  $user_password = htmlspecialchars($_POST['user_password'], ENT_QUOTES, 'UTF-8');    // �Է¹��� user password
  $user_password2 = htmlspecialchars($_POST['user_password2'], ENT_QUOTES, 'UTF-8');  // �Է¹��� user password Ȯ�ο�
    
// ȸ������ �α��� ����. 
// 1 = ȸ������, 2 = �α���
  if($_GET['signtype'] == '1'){   // ȸ������
    if(!empty($user_id)){
     // ȸ������ �ڷ��Է� �� ó��
      $row = $usersFunction->seachUser('SELECT `user_id` FROM `user`');  // User ID ��ȯ
      foreach($row as $users){
       // �̹� ���Ե��ִ� �ߺ����̵� üũ    
        if($users['user_id'] == $user_id){
          echo '<script name="javascript"> window.alert("Please enter the duplicate ID again."); history.go(-1);</script>';
        }
      }
      
      if($user_password != $user_password2){
       // ��й�ȣ ó���Է��� ���� ������ üũ
        echo '<script name="javascript"> window.alert("Please enter the duplicate password again."); history.go(-1);</script>';
      }else{
       // ��й�ȣ ������ Insert (DB�� ����)
        $param = [
            'user_id'=>$user_id,
            'user_password'=>$user_password
        ];
       // Insert 
        $usersFunction->insertData('INSERT INTO `user` SET `user_id` = :user_id,`user_password` = :user_password',$param);
        header('location: ../php/index.php');
      }
    }else{
     // ȸ������ �ڷ��Է� �� ó��
      $button = 'Join';
      $title = 'Sign Up';
     // ���� ����
      ob_start();
      include __DIR__ .'/../templates/userInForm.html.php';
      $outString = ob_get_clean();
    }
  }else if($_GET['signtype'] == '2'){   // �α���
    if(!empty($user_id)){
      // �α��� �ڷ��Է� �� ó��
      $row = $usersFunction->seachUser('SELECT * FROM `user`');  // User�� ���� ��ȯ
      foreach($row as $users){
        if($users['user_id'] != $user_id){
         // ���̵� Ȯ��
          echo '<script name="javascript"> window.alert("Please re-enter your ID."); history.go(-1);</script>';
        }else if($users['user_password'] != $user_password){
         // ��й�ȣ Ȯ��
          echo '<script name="javascript"> window.alert("The password is wrong. Please re-enter."); history.go(-1);</script>';
        }else if($user_password != $user_password2){
         // ��й�ȣ ��Ȯ��
          echo '<script name="javascript"> window.alert("Please enter the duplicate password again."); history.go(-1);</script>';
        }else{
          header('location: ../php/index.php?id='.$user_id); 
        }
      }
    }else{
      // �α��� �ڷ��Է� �� ó��
      $button = 'Log In';
      $title = 'Log In';
      
    // ���� ����
      ob_start();
      include __DIR__ .'/../templates/userInForm.html.php';
      $outString = ob_get_clean();
    }
  }
 }catch(PDOException $e){
  $outString='<p>Error : ' . $e->getMessage(). $e->getFile(). ' Line : ' . $e->getLine() .'</p>';
 }
 include __DIR__ .'/../templates/userInformation.html.php';