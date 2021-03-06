<div class="writingView">
  <div class="writing-view">
    <div class="writing-view_title">
      <span><?=$view[0]['title']?></span>
      <span>Writer : <?=$view[0]['user_id']?></span>
    </div>
    <div class="writing-view_discription">
      <p><?=$view[0]['discription']?></p>
    </div>
    <div class="writing-view_writer">
      <?php if($userConfirm) {?>
        <form action="../controllers/writingModify.php<?=$user?>&pageid=<?=$pageid?>" method="POST">
          <input type="submit" value="Modify">
          <a href="../controllers/writingDelete.php<?=$user?>&pageid=<?=$pageid?>">
            <input type="button" value="DELETE">
          </a>
        </form>
      <?php }?>
    </div>
  </div>

  <div class="writing-comment">
    <div class="writing-comment_input">
      <span>Comments</span>
      <form action="../controllers/writingComment.php<?=$user?>&pageid=<?=$pageid?>" method="POST">
        <textarea name="comment_discription" required="true"></textarea>
        <input type="submit" value="ADD" >
      </form>
    </div>
    <?php foreach($comments as $row) : ?>
      <div class="writing-comment_comments">
        <span>Nick : <?=$row['user_id']?></span>
        <br>
        <p><?=$row['discription']?></p>
      </div>
    <?php endforeach; ?>
  </div>
</div>