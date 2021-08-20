<div class="writing-form">
  <form action="writingUpload.php<?=$user?>" method="POST">
    <div class="writing-form_title">
      <label for="title">TITLE : </label>
      <input type="text" id="title" name="title" required="true">
    </div>
    <div class="writing-form_discription">
      <label for="dis">Discription</label>
      <br>
      <textarea id="dis" name="discription" required="true"></textarea>
    </div>
    <input type="submit" value="Upload">
  </form>
</div>