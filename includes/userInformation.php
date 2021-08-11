<?php   // 유저 로그인 로그아웃 정보
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
 // 로그인 url Get 변수 (로그인 user)
  $user = isset($_GET['id'])?'?id='.$_GET['id']:"";