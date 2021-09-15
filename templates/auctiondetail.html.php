<div class="auction-detail">
  <div class="auction-detail_bid">
    <?php echo '<img src="data:image/bmp;base64,' . base64_encode( $result1[0][3] ) . '" />';?>
    <div class="auction-detail_bidding">
      <h4 class="auction-detail_bidding_h4">Real-time bidding</h4>
      <h4> <?=$buyuser[0]['user_id']?> : <?=$buyuser[0]['items_price']?> \</h4>
      <div class="auction-detail_bidding_buy">
        <form action="" method="post">
          <input type="text" name="items_price" placeholder="bid price" class="auction-detail_bidding_buy__price">
          <input type="submit" value="buy">
          <br>
          <input type="text" name="article_sell" placeholder="immediate sale price" class="auction-detail_bidding_buy__price">
          <input type="submit" value="buy">
        </form>
        <?php if($userConfirm) {?>
          <div class="auction-detail_bidding_buy__endBt">
            <a href="../controllers/auctionDelete.php<?=$user?>&auction=<?=$auctionId?>"><input type="button" value="DELETE"></a>
            <a href="../controllers/auctionEnd.php<?=$user?>&auction=<?=$auctionId?>">
              <input type="button" value="END">
            </a>
          </div>
        <?php }?>
      </div>
      <div class="auction-detail_bidding_detail">
        <table border="1">
          <tr>
            <td>Writer</td>
            <td><?=$result1[0][0]?></td>
          </tr>
          <tr>
            <td>bid price</td>
            <td><?=$result1[0][5]?>\</td>
          </tr>
          <tr>
            <td> immediate sale price </td>
            <td><?=$result1[0][7]?>\</td>
          </tr>
        </table>
      </div>
    </div>
  </div>
  <div class="auction-detail_discription">
    <span>Product Information</span>
    <p><?=$result1[0][4]?></p>
  </div>
</div>