<?php
include 'constants.php';
extract($_GET);
if (!$companyName) {
    echo "No Company Name<br>";
    die();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo "$companyName ? $companyName : 'Company'" . "Products"; ?></title>
    <style>
        table,
        td,
        th {
            border: 1px solid black;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        td {
            text-align: center;
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

    $products = get_products($database, $companyName);

    print("<h3>Product List</h3>");

    print("<ol>");
    // product_id, name, company_name, description, url, visits
    foreach ($products as $row) {
        print("<li>");
        print("<a href='product.php?productId=$row[0]'>" . "$row[1]" . "</a>" . "<br>" . "$row[3]");
        print("</li>");
    }
    print("</ol>");

    print("<hr>");

    print("<h3>Top 5 Visited Products</h3>");
    $top5Prod = get_top_5($database, $companyName);

    print("<table>");
    print("<tr><th>Product Name</th><th>Visit Times</th></tr>");
    foreach ($top5Prod as $row) {
        print("<tr>");
        print("<td>$row[1]</td><td>$row[5]</td>");
        print("</tr>");
    }
    print("</table>");

    print("</ol>");

    print("<hr>");

    
    print("<h3>Top 5 Rated(Avg) Products</h3>");
    $top5Prod = get_top_5_reviewed($database, $companyName);

    print("<table>");
    print("<tr><th>Product Name</th><th>Visit Times</th></tr>");
    foreach ($top5Prod as $row) {
        print("<tr>");
        print("<td>$row[0]</td><td>$row[1]</td>");
        print("</tr>");
    }
    print("</table>");


    mysqli_close($database);
    ?>

    <?php
    function get_products($db, $companyName)
    {
        $q = "select * from products where company_name = '$companyName';";
        $list = array();
        $res = mysqli_query($db, $q);
        while ($row = mysqli_fetch_array($res))
            $list[] = $row;
        return $list;
    }

    function get_top_5($db, $companyName)
    {
        $q = "select * from products where company_name = '$companyName' order by visits desc limit 5;";
        $list = array();
        $res = mysqli_query($db, $q);
        while ($row = mysqli_fetch_array($res))
            $list[] = $row;
        return $list;
    }

    function get_top_5_reviewed($db, $companyName)
    {
        $q = "select name, COALESCE(Avg(R.rating),0) FROM reviews AS R RIGHT JOIN products AS P ON R.product_id = P.product_id where company_name = '$companyName' GROUP BY P.product_id ORDER BY AVG(rating) DESC LIMIT 5;";
        $list = array();
        $res = mysqli_query($db, $q);
        while ($row = mysqli_fetch_array($res))
            $list[] = $row;
            
        return $list;
    }
    ?>

    

</body>

</html>