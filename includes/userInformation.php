<?php   // 유저 로그인 로그아웃 정보
if(isset($_GET['user_id'])){
  $userInform = '유저 DB 정보 닉네임';
  $userInOut = 'Log out';
}else{
  $userInform = 'Sign Up';
  $userInOut = 'Log In';
}