<?php
include('includes/config.php');

if($user->checkUserRecordExists($_POST['username'], $_POST['email'])){
    $message =  'user details already exist. please check and try again';
} else {
    $user->createUser($_POST);
    $message =  'registration successful. You may now login.';
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
    <link href="css/style.css" rel="stylesheet" type="text/css">
</head>
<body>
<div class="container">
    <div class="row">
        <h1>OO-Blog</h1>
    </div>
    <div class="row">
        <div class="forms">
            <div class="col-md-6">
                <?php if(isset($message)){ echo $message; } ?>
                <h2>Register:</h2>
                <form action="" method="POST">
                    <div class="form-group">
                        <label for="username">Username:</label>
                        <input name="username" class="form-control" id="username" type="text" placeholder="Username" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input name="email" class="form-control" id="email" type="email" placeholder="Email" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input name="password" class="form-control" id="password" type="password" placeholder="Password" required>
                    </div>
                    <div class="control">
                        <button type="submit" name="submit" class="btn btn-default">Register</button>
                        <a class="btn btn-default" href="index.php">Back</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>