<!DOCTYPE html>
<html lang="en">
	<head>
		<?php include 'constants.php';?>
	</head>
	<body>
		<?php
			extract($_POST);
			if (!$username || !$password || !$email) {
				fieldsBlank();
				die();
			}
            $query="insert into users (username, password, email) values "."("."'{$username}',"."'{$password}',"."'{$email}'".");";
            $database = mysqli_connect($db_server, $db_user, $db_password, $db_name);
            if (!$database || $database -> connect_errno) {
                    echo "<p>Failed to connect to MySQL: " . $database -> connect_error."</p>";
                    exit();
            }
            mysqli_query($database, $query);
            if (!(mysqli_insert_id($database))) {
                    echo "Error: ".mysqli_error($database);
                    exit();
            }
			echo "Registered as {$username} with id ".mysqli_insert_id($database);
			mysqli_close($database);
		?>
		<a href='home.php'><button>Back to Home Page</button></a>

		<?php function fieldsBlank() {
			echo "<p>Required field is not provided. Registration Failed.</p>";
			echo "<a href='loginform.php'><button>Back to Login</button></a>";
		} ?>
	</body>
</html>
