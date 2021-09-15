<form action="" method="post">
  <div class="user-formTitle">
    <h1><?=$title?></h1>
  </div>
  <div class="user-form">
    <label for="userid">ID</label>
    <input type="text" name="user_id" required minlength="4" maxlength="10" id="userid">
    <label for="userPassword">PassWord</label>
    <input type="password" name="user_password" required minlength="4" maxlength="15" id="userid">
    <input type="password" name="user_password2" required minlength="4" maxlength="15" id="userid">
    <div class="user-form_bottom">
      <input type="submit" value="<?=$button?>">
    </div>
  </div>
  
</form>