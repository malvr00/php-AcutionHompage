<div class="articles-grid">
  <?php foreach($result as $array) {?>
    <?php if($array['article_end'] == '1'){?>
      <div class="articles-grid_items">
        <a href="../controllers/auctiondetail.php?auction=<?=$array['article_id']?>&<?=$user?>">
          <?php echo '<img src="data:image/bmp;base64,' . base64_encode( $array['article_image'] ) . '" />';?>
          <h4><?php echo $array['article_title']; ?> </h4>
        </a>
        <span>View : <?=$array['article_views']?></span>
      </div>
    <?php }?>
  <?php } ?>
</div>