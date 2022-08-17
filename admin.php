<?php
include('includes/config.php');
require_once('classes/user.php'); //create a user controller class to hanle user stuff maybe
$blogPostsForUser = $blog->getBlogPostsForUser($_SESSION['userId']);
include('includes/siteheader.php');

?>
<div class="container">
    <div class="row">
        <div class="col-sm-8 blog-main">
            <table class="table">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Post</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($blogPostsForUser as $blogPost): ?>
                    <tr>
                        <td><?=$blogPost['title']; ?></td>
                        <td><?= strlen($blogPost['blog_post']) > 50 ? substr($blogPost['blog_post'],0,25)."..." : $blogPost['blog_post']; ?></td>
                        <td><a href="editpost.php?id=<?= $blogPost['blog_post_id'] ?>">Edit post</a></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div><!-- /.blog-main -->
        <?php include('includes/sidebar.php'); ?>
    </div><!-- /.row -->
</div><!-- /.container -->

<?php include('includes/footer.php');?>
