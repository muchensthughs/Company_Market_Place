<!DOCTYPE html>
<html lang="en">
<?php include 'style.php'?>

<head>
</head>

<body>
    <div class="pt-5 w-25 mx-auto">
        <form class="pb-4" method="post" action="login.php">
            <p>
                <label for="username">Username</label>
                <input class="form-control" type="text" name="username" id="username" />
            </p>
            <p>
                <label for="password">Password</label>
                <input class="form-control" type="password" name="password" id="password" />
            </p>
            <p>
                <input type="submit" class="btn btn-primary" />
            </p>
        </form>
        <p>or</p>
        <?php include 'googlelogin.php' ?>

    </div>
</body>

</html>