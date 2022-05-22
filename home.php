<?php include ('constants.php')

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Marketplace</title>

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" rel="nofollow" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
<style>
  html, body {
    margin: 0px;
    min-height: 100%;
    height: 100%;
  }
  body {
    min-height:100%;
    position:relative;
    padding-bottom: 50px;
  }

  #footer {
    height: 50px;
    position: absolute;
    left: 0 ; right: 0; bottom: 0;
    flex-shrink: 0;
  }

</style>
  </head>
  <body>
    <div>
  <?php
  if(!isset($_SESSION))
{
    session_start();
}
  include("header.php")
   ?>
</div>

  <div id="myCarousel" class="carousel slide" data-ride="carousel">
      <!-- Indicators -->
      <div class="carousel-inner" role="listbox">

        <div class="container market" style="margin-top: 40px;">

      <!-- Three columns of text below the carousel -->
      <div class="row">
        <div class="col-lg-4">
          <h4>Mu Chen</h4>
            <p><a class="btn btn-default" href="company.php?companyName=hellopika" role="button">Visit site >></a></p>
        </div><!-- /.col-lg-4 -->
        <div class="col-lg-4">
          <h4>Avinash Pakala</h4>
            <p><a class="btn btn-default" href="company.php?companyName=nftart" role="button">Visit site >></a></p>
        </div><!-- /.col-lg-4 -->
        <div class="col-lg-4">
          <h4>Evan Yang</h4>
          <p><a class="btn btn-default" href="company.php?companyName=My Cram School" role="button">View site >></a></p>
        </div><!-- /.col-lg-4 -->
        <div class="col-lg-4">
            <h4>Muhammed Mahmood</h4>
            <p><a class="btn btn-default" href="company.php?companyName=qaraar">Visit site >></a></p>
        </div><!-- /.col-lg-4 -->
        <div class="col-lg-4">
            <h4>Anesha Pandian</h4>
            <p><a class="btn btn-default" href="company.php?companyName=Mipelo">Visit site >></a></p>
        </div>
      </div>
</div> </div> </div>
        <footer  id="footer">
<!--  <p class="pull-right"><a href="#">Back to top</a></p> -->

      <!-- <p style="margin-left: 10px;">&copy; CMPE 272- Enterprise Software Platforms.</p> -->
  </footer>

<script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ" crossorigin="anonymous"></script>
</body>
</html>
