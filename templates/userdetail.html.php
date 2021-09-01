<?php foreach($result as $row): ?>
  <div class="userdetail_page">
    <span>Name : <?=$row['user_id']?> </span>
    <span>Point : <?=$row['infor_point']?></span>
    <span>Enrollment : <?=$row['infor_auctionCnt']?> EA</span>
    <span>successful bid : <?=$row['infor_sfb']?> EA</span>
    <form action="../controllers/userSecession.php<?=$user?>" method="POST">
      <a href="../controllers/charging.php<?=$user?>"><input type="button" value="Point charging"></a>
      <input type="submit" value="Secession" onclick="checkDelete()">
      <input type="hidden" name="delete" id="delete" value="">
    </form>
  </div>
<?php endforeach; ?>
<script type="text/javascript">
// È¸¿øÅ»Åð È®ÀÎ
  function checkDelete(){
    var check = confirm("Do you want to cancel membership?");
    if(check)
      document.getElementById("delete").value = "YES";
    else
      document.getElementById("delete").value = "NO";
  }
</script>