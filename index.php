<?php
require_once('includes/config.php');

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Index</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
        <link href="css/style.css" rel="stylesheet" type="text/css">
    </head>
    <body>
    <div class="container">
        <div class="row">
            <h1>OO-Blog</h1>
        </div>
        <div class="row">
            <h2 class="blog-post-title">You must be logged in to view this blog</h2>
            <div class="forms">
                <div class="col-md-6">
                    <h2>Login:</h2>

                    <?php
                    if(isset($_POST['submit'])){
                        $username = trim($_POST['username']);
                        $password = trim($_POST['password']);
                        if($user->login($username,$password)){
                            header('Location: home.php');
                            exit;
                        } else {
                            $message = '<p class="error">Wrong username or password</p>';
                        }
                    }

                    if(isset($message)){ echo $message; }
                    ?>
                    <form action="" method="POST">
                        <div class="form-group">
                            <label for="username">Username: </label>
                            <input type="text" class="form-control" id="username" name="username" placeholder="Enter username" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password: </label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Enter password" required>
                        </div>
                        <div class="form-group">
                            <button type="submit" name="submit" class="btn btn-default">Login</button> <a class="btn btn-default" href="registration.html">Register</a>
                        </div>
                    </form>
                </div>
            </div>
            </div>
        </div>
        </div>
    </div>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </body>
</html>
