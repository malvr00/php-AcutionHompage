<?php foreach($result as $array) {?>
  <div class="articles">
    <a href="../controllers/auctiondetail.php?auction=<?=$array['article_id']?>&<?=$user?>">
      <?php echo '<img src="data:image/bmp;base64,' . base64_encode( $array['article_image'] ) . '" />';?>
      <h4><?php echo $array['article_title']; ?> </h4>
    </a>
  </div>
<?php } ?>