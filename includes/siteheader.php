<?php
$userId = $_SESSION['userId'];
$user->getUserById($userId);
if(!$user->is_logged_in()){ header('Location: index.php'); }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>OO Blogsite</title>
    <link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/blog/">

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <!-- Custom styles for this template -->
    <link href="../css/blog.css" rel="stylesheet" type="text/css">
</head>

<body>

<?php include('menu.php');?>

<div class="blog-header">
    <div class="container">
        <h1 class="blog-title">OO Blog Site</h1>
        <p class="lead blog-description">This is an example blog template built with Bootstrap & OO PHP.</p>
    </div>
</div>
