<div class="enrollment-form">
  <form enctype="multipart/form-data" action="" method="POST">
    <div class="enrollment-form_image">
      <label for="file">Stuff image</label>
      <input type="file" id="file" name="article_image" required="true">
    </div>
    <div class="enrollment-form_Contents">
      <label for="title">Title</label>
      <input type="text" id="title" name="article_title" required="true"></textarea>
      <label for="discription">Discription</label>
      <textarea id="discription" name="article_discription" required="true"></textarea>
      <label for="category">Category</label>
      <select id="category" name="article_category">
        <option value="toy">Toy</option>
        <option value="elec">Elec</option>
        <option value="food">Food</option>
        <option value="etc">Etc</option>
      </select>
      <label for="early">Early</label>
      <input type="text" id="early" name="article_price" required="true">
      <label for="sell">Sell immediately</label>
      <input type="text" id="sell" name="article_sell" required="true">
      <input type="submit" value="ADD">
    </div>
  </form>
</div>
