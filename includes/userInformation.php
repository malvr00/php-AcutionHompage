<?php   // 유저 로그인 로그아웃 정보
  if(!empty($_GET['id'])){
    $userInform = 'Nick Name : ' . $_GET['id'];
    $userInOut = 'Log out';
  }else{
    $userInform = 'Sign Up';
    $userInOut = 'Log In';
  }
 // 로그인 url Get 변수 (로그인 user)
  $user = isset($_GET['id'])?'?id='.$_GET['id']:"";