<div class="writing-screen">
  <?php foreach($result as $usersText): ?>
    <div class="user-writing">
      <span><?=$usersText['id']?>th</span>
      <a href="../controllers/writingView.php<?=$user?>&pageid=<?=$usersText['id']?>"><?=$usersText['title']?></a>
      <span>Writer:<?=$usersText['user_id']?></span>
    </div>
  <?php endforeach; ?>
    <div class="writing-pages">
      <a href="writing.php<?=$user?>&page=<?=$beforPage?>">이전</a>
      <?php for($i=$first; $i<=$last; $i++){?>
        <a href="writing.php<?=$user?>&page=<?=$i?>"><?=$i?></a>
      <?php }?>
      <a href="writing.php<?=$user?>&page=<?=$last + 1?>">다음</a>
    </div>
    <form action="" method="post">
        <input type="hidden" name="write" value="1">
        <input type="submit" value="write">
    </form>
</div>