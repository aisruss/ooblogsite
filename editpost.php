<?php
include('includes/config.php');
require_once('classes/user.php'); //create a user controller class to hanle user stuff maybe

$userId = $_SESSION['userId'];
$blogPostId = $_GET['id'];

$blog->getBlogPostById($blogPostId);
$userAuthorised = $blog->editPostAuthorisation($userId, $blogPostId);

if(isset($_POST['submit'])){
    $blog->editBlogPost($blogPostId, $_POST['title'], $_POST['blog_post']);
} else {
    $message = '<p class="error"></p>';
}

include('includes/siteheader.php');

?>

<div class="container">
    <div class="row">
        <div class="col-sm-8 blog-main">
            <h2  class="blog-title">Edit Post</h2>
            <div class="blog-post">
                <?php if ($userAuthorised) : ?>
                    <form action="" method="POST">
                        <div class="form-group">
                            <label for="title">Title: </label>
                            <input type='text' class='form-control' id='title' name='title' value='<?= $blog->getTitle();?>' required>
                        </div>
                        <div class="form-group">
                            <label for="blog_post">Post: </label>
                            <textarea class="form-control" id="blog_post" name="blog_post"required rows="13"><?= $blog->getBlogPost();?></textarea><br>
                        </div>
                        <div class="form-group">
                            <button type="submit" name="submit" class="btn btn-outline-secondary">Submit</button>
                        </div>
                    </form>
                <?php else: ?>
                    <h1>You are not allowed to edit this post.</h1>
                <?php endif; ?>
            </div><!-- /.blog-post -->
        </div><!-- /.blog-main -->
        <?php include('includes/sidebar.php'); ?>
    </div><!-- /.row -->
</div><!-- /.container -->
<?php include('includes/footer.php');?>
