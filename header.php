<h1><a href="index.php" class="logo" style = "text-decoration:none;">Market Place for Our Companies</a></h1>
<nav class="nav-items">
  
 <?php 
    if ($_COOKIE['userName']) {
        echo "<span>Welcome, ".$_COOKIE['userName']."</span>";
    } else {
        echo "<a href='loginform.php'>Login</a>";
        echo "<a href='registerform.php'>Register</a>";
    }
 ?>

</nav>