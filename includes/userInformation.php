<?php   // ���� �α��� �α׾ƿ� ����
  if(!empty($_GET['id']) || !empty($_GET['?id'])){
    $userNickname = !empty($_GET['id'])?$_GET['id']:$_GET['?id'];
    
    $userInform = 'Nick Name : ' . $userNickname;
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
  if(isset($_GET['id']))
    $user = '?id=' . $_GET['id'];
  else if(isset($_GET['?id']))
    $user = '?id=' . $_GET['?id'];
  else
    $user = "";