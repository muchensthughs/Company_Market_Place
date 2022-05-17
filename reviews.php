<!DOCTYPE html>
<html lang="en">
<?php include 'style.php'?>

<head>
</head>

<body>
    <?php include 'constants.php';
    $productId = 9;
    
    $query="select * from reviews where product_id="."'{$productId}';";
    
    
    if (!($results = mysqli_query($database, $query))) {
        echo "<p>Failed to execute query: ".mysqli_error($database)."</p>";
        exit();
    }

    if(mysqli_num_rows($results) == 0){
        echo "No Reviews Yet";
    }
?>
   <div class=" pt-4 w-75 mx-auto">
   <h2 class="pb-4 border-bottom">Products Reviews:</h2>

  <?php foreach($results as $row):?>
        <div class="card ">
        <div class="card-header">
        <?php  echo "User ID: " . $row['user_id']  . "'s Review" ?>
        </div>
        <div class="card-body pb-4">
            <h5 class="card-title"> <?php  echo "Rating: " . $row['rating'] ?></h5>
            <p class="card-text"><?php echo "Comment: " . $row['comment'] ?></p>
        </div>
    </div>
    <div class="pt-4"></div>

    <?php endforeach;?>
    <div>


</body>