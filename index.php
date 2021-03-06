<!DOCTYPE html>
<html lang="en">
	<head>
		<?php include 'constants.php';?>
		<link rel="stylesheet" href="header.css">
		<?php
		include "home.php";
		?>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
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


		print("<hr>");

		print("<h3>Top 5 Visited Products in our Market Place</h3>");
		$top5Prod = get_top_5($database);

		print("<table>");
		print("<tr><th>Product Name</th><th>Company</th><th>Description</th><th>Visit Times</th></tr>");
		foreach ($top5Prod as $row) {
			print("<tr>");
			print("<td><a href='product.php?productId=$row[0]'>$row[1]</a></td><td>$row[2]<td>$row[3]</td><td>$row[5]</td>");
			print("</tr>");
		}
		print("</table>");

		print("<hr>");

		print("<h3>Top 5 Best Rated Products in our Market Place</h3>");
		$top5Prod = get_top_5_reviewed($database);

		print("<table>");
		print("<tr><th>Product Name</th><th>Company</th><th>Rating(Avg)</th></tr>");
		foreach ($top5Prod as $row) {
			print("<tr>");
			print("<td>$row[0]</td><td>$row[1]</td><td>$row[2]</td>");
			print("</tr>");
		}
		print("</table>");

	    print("<p style='margin-left: 10px;'>&copy; CMPE 272- Enterprise Software Platforms.</p> ");

		mysqli_close($database);
		?>

		<?php

		function get_top_5($db)
		{
			$q = "select * from products order by visits desc limit 5;";
			$list = array();
			$res = mysqli_query($db, $q);
			while ($row = mysqli_fetch_array($res))
				$list[] = $row;
			return $list;
		}

		function get_top_5_reviewed($db)
		{
			$q = "select name,company_name, COALESCE(Avg(R.rating),0) FROM reviews AS R RIGHT JOIN products AS P ON R.product_id = P.product_id  GROUP BY P.product_id ORDER BY AVG(rating) DESC LIMIT 5;";
			$list = array();
			$res = mysqli_query($db, $q);
			while ($row = mysqli_fetch_array($res))
				$list[] = $row;
				
			return $list;
		}
		?>
	
	</body>

</html>
