<?php
include 'constants.php';
$product_id = isset($_POST['product_id']) ? $_POST['product_id'] : null;
$database = mysqli_connect($db_server, $db_user, $db_password, $db_name);
if (!$database || $database->connect_errno) {
    echo "<p>Failed to connect to MySQL: " . $database->connect_error . "</p>";
    exit();
}
if ($product_id) {
    add_product_click($database, $product_id);
}

function add_product_click($db, $product_id) {
    $q = "update products set visits = visits + 1 where product_id = $product_id;";
    $res = mysqli_query($db, $q);
}

?>