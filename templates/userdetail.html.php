<?php foreach($result as $row): ?>
  <div class="userdetail_page">
    <span>Name : <?=$row['user_id']?> </span>
    <span>Point : <?=$row['infor_point']?></span>
    <span>Enrollment : <?=$row['infor_auctionCnt']?> EA</span>
    <span>successful bid : <?=$row['infor_sfb']?> EA</span>
    <form action="" method="POST">
      <a href="../controllers/charging.php<?=$user?>"><input type="button" value="Point charging"> </a>
    </form>
  </div>
<?php endforeach; ?>