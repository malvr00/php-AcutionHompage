<?php   // ���� �α��� �α׾ƿ� ����
  if(!empty($_GET['id'])){
    $userInform = 'Nick Name : ' . $_GET['id'];
    $userInOut = 'Log out';
  }else{
    $userInform = 'Sign Up';
    $userInOut = 'Log In';
  }
 // �α��� url Get ���� (�α��� user)
  $user = isset($_GET['id'])?'?id='.$_GET['id']:"";