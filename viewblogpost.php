<?php
include('includes/config.php');
require_once('classes/user.php'); //create a user controller class to hanle user stuff maybe

$blogPostId = $_GET['id'];
$blogPost = $blog->getBlogPostById($blogPostId);
$blogComments = $blog->getBlogPostComments($blogPostId);
$userId = $_SESSION['userId'];

if(isset($_POST['submit'])){
    $blog->addBlogPostComment($blogPostId, $userId, $_POST['comment']);
} else {
    $message = '<p class="error"></p>';
}

include('includes/siteheader.php');

?>

<div class="container">
    <div class="row">
        <div class="col-sm-8 blog-main">
                <div class="blog-post">
                    <h1><?=$message;?></h1>
                    <h2 class="blog-post-title"><?=$blog->getTitle(); ?></h2>

                    <p class="blog-post-meta"><?=$blog->getSubmittedOn(); ?> by <a href="blogpostsforuser.php?id=<?php echo $blogPost['user_id'] ?>"><?= $blog->getBlogAuthor() ?></a></p>
                    <?=$blog->getBlogPost(); ?>
                </div><!-- /.blog-post -->
                <hr>
                <div class="blog-post">
                    <!-- add a new comment -->
                    <h5>Add Comment:</h5>
                    <form action="" method="POST">
                        <div class="form-group">
                            <textarea class="form-control" id="blog_post" name="comment" placeholder="Add comment" required rows="5"></textarea><br>
                        </div>
                        <div class="form-group">
                            <button type="submit" name="submit" class="btn btn-outline-secondary">Comment</button>
                        </div>
                    </form>
                </div>
            <div>
                <h5>Comments on this post</h5>
                        <?php foreach ($blogComments as $comment): ?>
                            <div class="blog-post-comment">
                                <h6><?=$comment['created_by']; ?> says: </h6>
                                <p style="padding-left: 20px"><?=$comment['comment']; ?></p>
                                <p> Commented on: <?=$comment['submitted_on']; ?></p>
                            </div>
                            <br>
                        <?php endforeach; ?>
                <?php if (count($blogComments) < 1 ) { echo 'No comments yet'; } ?>
            </div>
        </div><!-- /.blog-main -->
        <?php include('includes/sidebar.php'); ?>
    </div><!-- /.row -->
</div><!-- /.container -->
<?php include('includes/footer.php');?>
