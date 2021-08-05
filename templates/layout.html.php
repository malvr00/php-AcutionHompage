<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../css/styles.css">
    <title><?=$title?></title>
  </head>
  <body>
    <header class="main-header">
      <div class="login-bar">
        <a href="../controllers/userInOut.php?signtype=1">Sign Up</a>
        <a href="#">Log In</a>
      </div>
      <h1><a href="../php/index.php">Auction</a></h1>
    </header>
    
    <nav class="status-bar">
      <ul>
        <li><a href="../controllers/writing.php">User bulletin board </a></li>
        <li><a href="#">Auction bulletin board</a></li>
        <li><a href="#">Auction Enrollment</li>
        <li><a href="#">Service center</a></li>
      </ul>
    </nav>
    
    <main class="main-screen">
      <?=$outString?>
    </main>
    
    <footer class="footer">
      <h4> 2021. 08 &copy yong il<h4>
    </footer>
  </body>
</html>