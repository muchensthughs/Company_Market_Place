<?php include 'constants.php';?>
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
			$row = mysqli_fetch_array($results);
			setcookie('userId', $row['id']);
			setcookie('userName', $row['username']);
			mysqli_close($database);
?>
<?php function accessDenied() {
			echo "<p>Password or username not correct. Access Denied.</p>";
			echo "<a href='loginform.php'><button>Back to Login</button></a>";
		} ?>
<?php function fieldsBlank() {
			echo "<p>Password or username is not provided. Access Denied.</p>";
			echo "<a href='loginform.php'><button>Back to Login</button></a>";
		} ?>

<!DOCTYPE html>
<html lang="en">
	<head>
	</head>
	<body>
		<a href='index.php'><button>Back to Home Page</button></a>
	</body>
</html>
