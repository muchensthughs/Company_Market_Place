<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Company</title>
</head>

<body>
    <?php include 'constants.php'; ?>
    <?php
    extract($_GET);
    if (!$companyName) {
        echo "No Company Name<br>";
        die();
    }
    $query = "select * from products where company_name = '$companyName';";
    $database = mysqli_connect($db_server, $db_user, $db_password, $db_name);
    if (!$database || $database->connect_errno) {
        echo "<p>Failed to connect to MySQL: " . $database->connect_error . "</p>";
        exit();
    }

    echo $query . "<br>";
    $results = mysqli_query($database, $query);

    print("<h3> Search Result </h3>");
    print("<table>");

    // <th> column name </th>
    print("<tr>");
    print("<th>product_id</th>");
    print("<th>name</th>");
    print("<th>company_name</th>");
    print("<th>description</th>");
    print("<th>url</th>");
    print("<th>visits</th>");
    print("</tr>");

    // fetch each record in result set
    for ($counter = 0; $row = mysqli_fetch_row($results); $counter++) {
        print("<tr>");
        foreach ($row as $key => $value)
            print("<td>$value</td>");
        print("</tr>");
    }

    print("</table>");


    print("Top 5 Products<br>");
    $top5Prod = get_top_5($database, $companyName);


    foreach ($top5Prod as $row) {
        echo "Name: $row[1], visit times: $row[5]<br>";
    }



    mysqli_close($database);
    ?>

    <?php
    function get_top_5($db, $companyName)
    {
        $q = "select * from products where company_name = '$companyName' order by visits desc limit 5;";
        $listingdata = array();
        $result = mysqli_query($db, $q);
        while ($row = mysqli_fetch_array($result))
            $listingdata[] = $row;

        return $listingdata;
    }
    ?>

</body>

</html>