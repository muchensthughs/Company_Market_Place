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
            if (!($results = mysqli_query($database, $query)) || $results->num_rows === 0) {
					accessDenied();
                    exit();
            }
			echo "Logged in as {$username}";
			mysqli_close($database);
		?>
		<a href='index.php'><button>Back to Home Page</button></a>
					
		<?php function accessDenied() {
			echo "<p>Password or username not correct. Access Denied.</p>";
			echo "<a href='loginform.php'><button>Back to Login</button></a>";
		} ?>
		<?php function fieldsBlank() {
			echo "<p>Password or username is not provided. Access Denied.</p>";
			echo "<a href='loginform.php'><button>Back to Login</button></a>";
		} ?>
	</body>
</html>
