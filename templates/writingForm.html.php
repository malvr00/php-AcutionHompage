<?php foreach($result as $usersText): ?>
  <div class="user-writing">
    <span><?=$usersText['id']?>th</span>
    <a href="../controllers/writingView.php<?=$user?>&pageid=<?=$usersText['id']?>"><?=$usersText['title']?></a>
    <span>Writer:<?=$usersText['user_id']?></span>
  </div>
<?php endforeach; ?>
  <?php for($i=$first; $i<=$last; $i++){?>
    <a href="writing.php<?=$user?>&page=<?=$i?>"><?=$i?></a>
  <?php }?>
<form action="" method="post">
    <input type="hidden" name="write" value="1">
    <input type="submit" value="write">
</form>