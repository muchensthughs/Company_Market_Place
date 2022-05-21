<?php
include 'constants.php';
extract($_GET);
if (!$productId) {
    echo "No Product Selected<br>";
    die();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include 'style.php'?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <style>
        .product_title {
	        display: flex;
            justify-content: space-between;
	        padding-left: 20px;
	        padding-right: 20px;
	        vertical-align: middle;
	        overflow: scroll;
            margin-top: 20px;
        }
        .prod_description {
            padding-left: 20px;
	        padding-right: 20px;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <?php
    $database = mysqli_connect($db_server, $db_user, $db_password, $db_name);
    if (!$database || $database->connect_errno) {
        echo "<p>Failed to connect to MySQL: " . $database->connect_error . "</p>";
        exit();
    }

    $product = get_product($database, $productId)[0];
    // product_id, name, company_name, description, url, visits
    if ($product) {
        echo "<div class='product_title'>";
        echo "<div>";
        echo "<h3><a target='_blank' rel='noopener noreferrer' href='$product[4]' class='click_product' productId='$product[0]' style = 'text-decoration:none;'>$product[1]</a></h3>";
        echo "From Company $product[2]";
        echo "</div>";
        echo "<div>";
        echo "<button style='background-color: green; border-radius: 5px; border: none; padding: 10px;'><a target='_blank' rel='noopener noreferrer' href='$product[4]' class='click_product' productId='$product[0]' style = 'text-decoration:none; color: white; font-size: 1.2em;'>Go To Product</a></button>";
        echo "</div>";
        echo "</div>";
        echo "<div class='prod_description'>";
        echo "<b>Description</b>";
        echo "<p>$product[3]</p>";
        echo "</div>";
    } else {
        echo "No product of this id available";
        die();
    }

    print("<hr>");

    include 'reviews.php';

    if ($_COOKIE['userName']) {
        if (!has_review_from_current_user($database, $productId, $_COOKIE['userId'])) {
            echo "<a href='reviewForm.php?productId=$productId'>Leave a review</a>";
        }
    } else {
        echo "<a href='loginform.php'>Login to leave a review</a>";
    }

    mysqli_close($database);
    ?>

    <?php
    function get_product($db, $product_id)
    {
        $q = "select * from products where product_id = $product_id;";
        $list = array();
        $res = mysqli_query($db, $q);
        while ($row = mysqli_fetch_array($res))
            $list[] = $row;
        return $list;
    }

    function has_review_from_current_user($db, $product_id, $user_id) {
        $q = "select * from reviews where product_id = $product_id and user_id = $user_id;";
        $res = mysqli_query($db, $q);
        if (mysqli_num_rows($res) === 0) {
            return false;
        } else {
            return true;
        }
    }
    ?>

</body>

<script>
    $(".click_product").click((e) => {
        request = $.ajax({
            url: "addClick.php",
            type: "POST",
            data: {"product_id": e.target.getAttribute('productId')}
        });
        request.done(function (response, textStatus, jqXHR){
            console.log(response);
        });
        request.fail(function (jqXHR, textStatus, errorThrown){
            console.error(
                "Error occurred in AJAX call: "+
                textStatus, errorThrown
            );
        });
    })
</script>

</html>