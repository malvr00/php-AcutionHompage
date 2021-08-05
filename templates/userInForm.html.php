<form action="" method="post">
  <label for="userid">ID</label>
  <input type="text" name="user_id" required minlength="4" maxlength="10" id="userid">
  <label for="userPassword">PassWord</label>
  <input type="password" name="user_password" required minlength="4" maxlength="15" id="userid">
  <input type="password" name="user_password2" required minlength="4" maxlength="15" id="userid">
  <input type="submit" value="<?=$button?>">
</form>