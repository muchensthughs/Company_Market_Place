<!DOCTYPE html>
<html lang="en">
	<head>
        	<?php include 'constants.php';?>
	</head>
	<body>
        <?php
                $query='select * from users;';
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
                <p>All my users:</p>
                <table cellspacing="2" border="1">
                    <tr>
                        <td>ID</td>
                        <td>Username</td>
                        <td>Password</td>
                        <td>Email</td>
                    </tr>
                    <?php 
                        while ($row = mysqli_fetch_row($results)) {
                            print("<tr>");
                            foreach($row as $key => $value) {
                                print("<td>$value</td>");
                            }
                            print("</tr>");
                        }
                        mysqli_close($database);
                    ?>
                </table>
    
	</body>
</html>
