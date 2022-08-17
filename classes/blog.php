<?php

class Blog {
    private $db;
    public $blogPostId;
    public $title;
    public $blogPost;
    public $submittedOn;
    public $blogAuthor;
    public $authorId;

    function __construct($db){

        $this->_db = $db;

        $this->blogPostId;
        $this->title;
        $this->blogPost;
        $this->submittedOn;
        $this->blogAuthor;
    }

    public function getBlogPostId() {
        return $this->blogPostId;
    }

    public function getTitle() {
        return $this->title;
    }

    public function setTitle($title) {
        $this->title = $title;
    }

    public function getBlogPost() {
        return $this->blogPost;
    }

    public function setBlogPost($blogPost) {
        $this->blogPost = $blogPost;
    }

    public function getSubmittedOn() {
        return $this->submittedOn;
    }

    public function setSubmittedOn($submittedOn) {
        $this->submittedOn = $submittedOn;
    }
    public function getBlogAuthor() {
        return $this->blogAuthor;
    }

    public function setBlogAuthor($blogAuthor) {
        $this->blogAuthor = $blogAuthor;
    }

    public function getAllBlogPosts(){
        try {
            $stmt = $this->_db->prepare('SELECT blogPost.*, user.username AS blog_author
                                            FROM `blog_posts` AS blogPost
                                            LEFT JOIN `users` AS user
                                            ON blogPost.user_id = user.user_id
                                            ORDER BY blogPost.submitted_on DESC;');
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);

        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function getBlogPostsForUser($userId){
        try {
            $stmt = $this->_db->prepare('SELECT blogPost.*, user.username AS blog_author
                                            FROM `blog_posts` AS blogPost
                                            LEFT JOIN `users` AS user
                                            ON blogPost.user_id = user.user_id
                                            WHERE blogPost.user_id = :user_id
                                            ORDER BY blogPost.submitted_on DESC;');

            $stmt->execute(array('user_id' => $userId));

            return $stmt->fetchAll(PDO::FETCH_ASSOC);

        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function getBlogPostById($blogPostId) {
        try {
            $stmt = $this->_db->prepare('SELECT blogPost.*, user.username AS blog_author
                                            FROM `blog_posts` AS blogPost
                                            LEFT JOIN `users` AS user
                                            ON blogPost.user_id = user.user_id
                                            WHERE blogPost.blog_post_id = :blog_post_id;');
            $stmt->execute(array('blog_post_id' => $blogPostId));

            $results = $stmt->fetch();
            $this->blogPostId = $results['blog_post_id'];
            $this->setTitle($results['title']);
            $this->setBlogPost($results['blog_post']);
            $this->setSubmittedOn($results['submitted_on']);
            $this->setBlogAuthor($results['blog_author']);
            $this->authorId = $results['user_id'];
            return;
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function getBlogPostComments($blogPostId){
        try {
            $stmt = $this->_db->prepare('SELECT blogPostComments.comment, blogPostComments.submitted_on, user.username AS created_by
                                            FROM `blog_post_comments` AS blogPostComments
                                            LEFT JOIN `users` AS user
                                            ON blogPostComments.user_id = user.user_id
                                            WHERE blogPostComments.blog_post_id = :blog_post_id;');
            $stmt->execute(array('blog_post_id' => $blogPostId));

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function addBlogPost($title, $blogPost, $userId) {
        try {

            //insert into database
            $stmt = $this->_db->prepare('INSERT INTO blog_posts (title,blog_post,submitted_on, user_id) VALUES (:postTitle, :blogPost, :submittedOn, :userId)') ;
            $stmt->execute(array(
                ':postTitle' => $title,
                ':blogPost' => $blogPost,
                ':submittedOn' => date("Y-m-d H:i:s"),
                ':userId' => $userId
            ));

            //redirect to index page soon to be redirect to view
            header('Location: home.php');
            exit;

        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function addBlogPostComment($blogPostId, $userId, $comment) {
        try {
            //insert into database
            $stmt = $this->_db->prepare('INSERT INTO blog_post_comments (blog_post_id, user_id, comment, submitted_on ) VALUES (:blogPostId, :userId, :comment, :submittedOn)') ;
            $stmt->execute(array(
                ':blogPostId' => $blogPostId,
                ':userId' => $userId,
                ':comment' => $comment,
                ':submittedOn' => date("Y-m-d H:i:s"),

            ));

            //redirect to index page soon to be redirect to view
            header("location:viewblogpost.php?id=".$blogPostId);
            exit;

        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function editBlogPost($blogPostId, $title, $blogPost)
    {
        try {
            //insert into database
            $stmt = $this->_db->prepare('UPDATE blog_posts SET title = :title, blog_post = :blogPost WHERE blog_post_id = :blogPostID');
            $stmt->execute(array(
                ':blogPostID' => $blogPostId,
                ':title' => $title,
                ':blogPost' => $blogPost,
            ));

            //redirect to index page
            header('Location: viewblogpost.php?id=' . $blogPostId);
            exit;

        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function editPostAuthorisation($userId) {
        if ( $userId !== $this->authorId) {
            return false;
        } else {
            return true;
        }
    }
}