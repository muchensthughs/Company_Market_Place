<link rel="stylesheet" href="header.css">
<h1><a href="home.php" class="logo" style = "text-decoration:none; margin-left: 20px;">Market Place for Our Companies</a></h1>
<nav class="nav-items">
 <?php
    if ( isset($_COOKIE['username']) ) {
        echo "<span>Welcome, ".$_COOKIE['userName']."</span>";
    } else {
        echo "<a href='loginform.php'>Login</a>";
        echo "<a href='registerform.php'>Register</a>";
    }
 ?>

</nav>
