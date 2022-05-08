<!DOCTYPE html>
<html lang="en">
	<head>
		<?php include 'constants.php';?>
	</head>
	<body>
		<?php 
			extract($_POST);
			if (!$username || !$password) {
				fieldsBlank();
				die();
			}
                	$query="select * from users where username="."'{$username}'"." and password="."'{$password}';";
                	$database = mysqli_connect($db_server, $db_user, $db_password, $db_name);
                	if (!$database || $database -> connect_errno) {
                    		echo "<p>Failed to connect to MySQL: " . $database -> connect_error."</p>";
                    		exit();
                	}
                	if (!($results = mysqli_query($database, $query))) {
                    		echo "<p>Failed to execute query: ".mysqli_error($database)."</p>";
                    		exit();
                	}
        	?>
					
			<?php } 
				else {
				accessDenied();
			} ?>
		<?php function accessDenied() {
			echo "<p>Password and username not correct. Access Denied.</p>";
		} ?>
		<?php function fieldsBlank() {
			echo "<p>Password or username is not provided. Access Denied.</p>";
		} ?>
	</body>
</html>
