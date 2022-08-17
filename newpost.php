<?php
include('includes/config.php');

$userId = $_SESSION['userId'];

if(isset($_POST['submit'])){
   $blog->addBlogPost($_POST['title'], $_POST['blog_post'], $userId);
}

include('includes/siteheader.php');
?>
<div class="container">

    <div class="row">

        <div class="col-sm-8 blog-main">
            <div class="blog-post">
                <h2 class="blog-post-title">New Post</h2>
                <?php if(isset($message)){ echo $message; } ?>
                <form action="" method="POST">
                    <div class="form-group">
                        <label for="title">Title: </label>
                        <input type="text" class="form-control" id="title" name="title" placeholder="Enter title" required>
                    </div>
                    <div class="form-group">
                        <label for="blog_post">Post: </label>
                        <textarea class="form-control" id="blog_post" name="blog_post" placeholder="Enter post" required rows="13"></textarea><br>
                    </div>
                    <div class="form-group">
                        <button type="submit" name="submit" class="btn btn-outline-secondary">Submit</button>
                    </div>
                </form>
            </div><!-- /.blog-post -->
        </div><!-- /.blog-main -->

        <?php include('includes/sidebar.php'); ?>

    </div><!-- /.row -->

</div><!-- /.container -->

<?php include('includes/footer.php');?>
