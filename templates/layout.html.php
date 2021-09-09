<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../css/style.css" />
    <title><?=$title?></title>
  </head>
  <body>
    <header class="main-header">
      <div class="login-bar-image">
        <img src="../images/auctionImage.png" />
        <h1><a href="../php/index.php<?=$user?>">Auction</a></h1>
      </div>
      <div class="login-bar">
        <a href="<?=$userurl?>"><?=$userInform?></a>
        <a href="../controllers/userInOut.php?signtype=<?=$sgintype2?>"><?=$userInOut?></a>
      </div>
    </header>
    
    <nav class="status-bar">
      <ul>
        <li><a href="../controllers/writing.php<?=$user?>">User bulletin board </a></li>
        <li class="status-bar_category">
          <a href="../controllers/articleItems.php<?=$user?>">Auction bulletin board</a>
          <div class="status-bar_category_m1">
            <ul>
              <li><a href="../controllers/categoryMenu.php<?=$user?>&cate=toy">Toy</a></li>
              <li><a href="../controllers/categoryMenu.php<?=$user?>&cate=elec">Elec</a></li>
              <li><a href="../controllers/categoryMenu.php<?=$user?>&cate=food">Food</a></li>
              <li><a href="../controllers/categoryMenu.php<?=$user?>&cate=etc">Etc</a></li>
            </ul>
          </div>
        </li>
        <li>
          <a href="../controllers/enrollment.php<?=$user?>">Auction Enrollment</a>
        </li>
      </ul>
    </nav>
    
    <main class="main-screen">
      <?=$outString?>
    </main>
    
    <footer class="footer">
      <h4> 2021. 08 &copy yong il</h4>
    </footer>
  </body>
  <script src="../js/dispaly.js"></script>
</html>