<?php
include('includes/config.php');
require_once('classes/user.php');
$blogPostUserId = $_GET['id'];
$blogPostsForUser = $blog->getBlogPostsForUser($blogPostUserId);
include('includes/siteheader.php');

?>
<div class="container">
    <div class="row">
        <div class="col-sm-8 blog-main">
            <?php foreach ($blogPostsForUser as $blogPost): ?>
                <div class="blog-post">
                    <h2 class="blog-post-title"><?=$blogPost['title']; ?></h2>

                    <p class="blog-post-meta"><?=$blogPost['submitted_on']; ?> by <a href="blogpostsforuser.php?id=<?php echo $blogPost['user_id'] ?>"><?= $blogPost['blog_author'] ?></a></p>
                    <?= strlen($blogPost['blog_post']) > 50 ? substr($blogPost['blog_post'],0,250)."..." : $blogPost['blog_post']; ?>

                    <a href="viewblogpost.php?id=<?php echo $blogPost['blog_post_id'] ?>">view more</a>
                </div><!-- /.blog-post -->
                <hr>
            <?php endforeach; ?>
        </div><!-- /.blog-main -->
        <?php include('includes/sidebar.php'); ?>
    </div><!-- /.row -->
</div><!-- /.container -->

<?php include('includes/footer.php');?>
