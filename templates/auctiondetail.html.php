<div class="auction-detail">
  <div class="auction-detail_bid">
    <?php echo '<img src="data:image/bmp;base64,' . base64_encode( $result1[0][3] ) . '" />';?>
  </div>
  <div class="auction-detail_Infor">
    <div class="auction-detail_Infor_buy">
      <div class="auction-detail_Infor_bidding">
        <span>Real-time bidding  |</span>
        <span><?=$buyuser[0]['user_id']?> : <?=$buyuser[0]['items_price']?> \</span>
      </div>
      <form action="" method="post">
        <input type="text" name="items_price" placeholder="bid price">
        <input type="submit" value="buy">
        <br>
        <input type="text" name="article_sell" placeholder="immediate sale price">
        <input type="submit" value="buy">
      </form>
      <?php if($userConfirm) {?>
        <div class="auction-detail_Infor_endBt">
          <a href="../controllers/auctionDelete.php<?=$user?>&auction=<?=$auctionId?>"><input type="button" value="DELETE"></a>
          <a href="../controllers/auctionEnd.php<?=$user?>&auction=<?=$auctionId?>">
            <input type="button" value="END">
          </a>
        </div>
      <?php }?>
      <aside>
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
      </aside>
    </div>
  </div>
</div>