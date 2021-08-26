<div class="writing-form">
  <form action="../controllers/writingModify.php<?=$user?>&pageid=<?=$pageid?>" method="POST">
    <div class="writing-form_title">
      <label for="title">TITLE : </label>
      <input type="text" id="title" name="modify_title" value="<?=$view[0]['title']?>" required="true">
    </div>
    <div class="writing-form_discription">
      <label for="dis">Discription</label>
      <br>
      <textarea id="dis" name="modify_discription" required="true" ><?=$view[0]['discription']?></textarea>
    </div>
    <input type="submit" value="Modify">
    <input type="hidden" name="modify" value="modify">
  </form>
</div>