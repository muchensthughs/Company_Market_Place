<!DOCTYPE html>
<html lang="en">
 <?php include 'style.php';?> 

 <head>
<link rel="stylesheet" href="rating.css">
</head>
<?php  
   $userId = $_COOKIE['userId'];
?>
<body>
<div class=" pt-4 w-75 mx-auto">
        <form method="post" action="submitreview.php">
        <input type="hidden" id="user_id" name="user_id" value='<?php echo "$userId";?>'>
            <input type="hidden" id="product_id" name="product_id" value="9">
            <label class="rating-label"><strong>Rate the product <code>step="0.25"</code></strong>
                <input class="rating" max="5" oninput="this.style.setProperty('--value', `${this.valueAsNumber}`)"
                    step="0.25" style="--fill: #C8102E;--symbol:var(--heart);--value:2.75" type="range" value="3" name="rating">
            </label>
            <div class="pt-5">
                <p>
                    <label class="pb-3" for="comment">Submit a comment</label>
                    <textarea type="text" class="form-control" placeholder="Leave a comment here" style="height: 100px"
                        name="comment" id="comment" rows="7" cols="70"></textarea>
                </p>
            </div>
            <p>
                <input type="submit" class="btn btn-primary" />
            </p>
        </form>
    </div>
</body>

</html>