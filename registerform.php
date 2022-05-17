<!DOCTYPE html>
<html lang="en">
<?php include 'style.php'?>

<head>
</head>

<body>

    <div class="pt-5  w-25 mx-auto">
        <form method="post" action="register.php">
            <p>
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" name="username" id="username" />
            </p>
            <p>
                <label for="email" class="form-label">Email</label>
                <input type="text" class="form-control" name="email" id="email" />
            </p>
            <p>
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" name="password" id="password" />
            </p>
            <p>
                <input type="submit" class="btn btn-primary" />
            </p>
        </form>

    </div>

</body>

</html>