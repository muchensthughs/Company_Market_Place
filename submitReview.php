<!DOCTYPE html>
<html lang="en">
	<head>
		<?php include 'constants.php';?>
	</head>
	<body>
		<?php 
			extract($_POST);
			if (!$user_id || !$product_id || !$rating || !$comment) {
				fieldsBlank();
				die();
			}

			// check if user has already submitted a review
			$query = "select * from reviews where user_id ="."'{$user_id}'"." and product_id = "."'{$product_id}';"; 
			
			if (!($results = mysqli_query($database, $query))) {
				echo "<p>Failed to execute query: ".mysqli_error($database)."</p>";
				exit();
			}
		
			if(mysqli_num_rows($results) > 0){
				echo "Review already submitted";
				exit();
			}

            $query="insert into reviews (user_id, product_id, rating, comment) values "."("."'{$user_id}',"."'{$product_id}',"."'{$rating}',"."'{$comment}'".");";
            
            $database = mysqli_connect($db_server, $db_user, $db_password, $db_name);
            
            if (!$database || $database -> connect_errno) {
                    echo "<p>Failed to connect to MySQL: " . $database -> connect_error."</p>";
                    exit();
            }
           
            mysqli_query($database, $query);
            
            // if (!(mysqli_insert_id($database))) {
            //         echo "Error: ".mysqli_error($database);
            //         exit();
            // }
			echo "Successfully Review Submitted" ;
			echo "<hr>";
			echo "<button><a href='product.php?productId=$product_id'>Go Back to Product</a></button>";
			mysqli_close($database);
		?>					
		<?php function fieldsBlank() {
			echo "<p>Required field is not provided.Rating and comment both mandatory fields.Review Submission Failed.</p>";
			echo "<button><a href='product.php?productId=$product_id'>Go Back to Product</a></button>";
		} ?>
	</body>
</html>