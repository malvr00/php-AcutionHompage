<?php   // ���� �α��� �α׾ƿ� ����
  if(!empty($_GET['id'])){
    $userInform = 'Nick Name : ' . $_GET['id'];
    $userInOut = 'Log out';
    $sgintype1 = '3';
    $sgintype2 = '4';
  }else{
    $userInform = 'Sign Up';
    $userInOut = 'Log In';
    $sgintype1 = '1';
    $sgintype2 = '2';
  }
 // �α��� url Get ���� (�α��� user)
  $user = isset($_GET['id'])?'?id='.$_GET['id']:"";