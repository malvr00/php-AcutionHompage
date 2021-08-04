<?php foreach($result as $usersText): ?>
  <div class="user-writing">
    <span><?=$usersText['id']?>th</span>
    <a href="#"><?=$usersText['title']?></a>
    <span>Writer:<?=$usersText['user_id']?></span>
  </div>
<?php endforeach; ?>
<form action="#" method="post">
    <input type="hidden" name="user_id" value="100">
    <input type="submit" value="write">
</form>