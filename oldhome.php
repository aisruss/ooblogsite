<?php
include('includes/config.php');
require_once('classes/user.php'); //create a user controller class to hanle user stuff maybe

$accountId = $_SESSION['accountId'];
$userInfo = $user->getUserById($accountId);

if(!$user->is_logged_in()){ header('Location: index.php'); }

?>
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="utf-8">
        <title>Home Page</title>
        <link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/blog/">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link href="css/style.css" rel="stylesheet" type="text/css">
        <link href="css/blog.css" rel="stylesheet" type="text/css">
    </head>
<body class="loggedin">

<div class="container">

        <?php include('includes/menu.php');?>
    </div>
    <div class="row">
        <p>Welcome back, <?= $user->username;?>!</p>

        <div class="bloglist">
            <?php
            $blogPosts = $blog->getBlogPostForUser($accountId);

              if (is_array($blogPosts) && !empty($blogPosts)) {
                foreach ($blogPosts as $post)
                {
                    echo "<div class='post'>";
                    echo "<h2>" . $post['title'] . "</h2>";
                    echo "<p>" . $post['post_content'] . "</p>";
                    echo "</div>";
                }
            }
            ?>
        </div>
    </div>
</div>

<footer class="blog-footer">
    <p>Blog template built for <a href="https://getbootstrap.com">Bootstrap</a> by <a href="https://twitter.com/mdo">@mdo</a>.</p>
    <p>
        <a href="#">Back to top</a>
    </p>
</footer>


<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
<script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
<script src="../../dist/js/bootstrap.min.js"></script>
<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>
</body>
</html>
