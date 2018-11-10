<?php include "./includes/db.php"; ?>
<?php include "includes/header.php" ?>
<?php include "includes/navigation.php" ?>
<?php 
    if(isset($_GET['p_id'])) {
        $post_id = $_GET['p_id'];
        
        $sql = "SELECT * FROM posts WHERE post_id = '$post_id'";
        $get_post = mysqli_query($connection, $sql);

        $post_details = mysqli_fetch_assoc($get_post); 
        $postId = $post_details['post_id'];
        $postAuthor = $post_details['post_author'];
        $postContent = $post_details['post_content'];
        $postDate = $post_details['post_date'];
        $postImage = $post_details['post_image'];
        $postTitle = $post_details['post_title'];
    }
?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Post Content Column -->
            <div class="col-lg-8">

                <!-- Blog Post -->

                <!-- Title -->
                <h1><?= $postTitle ?></h1>

                <!-- Author -->
                <p class="lead">
                    by <a href="#"><?= $postAuthor ?></a>
                </p>

                <hr>

                <!-- Date/Time -->
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?= $postDate ?></p>

                <hr>

                <!-- Preview Image -->
                <img class="img-responsive" src="./images/<?= $postImage ?>" alt="">

                <hr>

                <!-- Post Content -->
                <p class="lead"><?= $postContent ?></p>
                <p><?= $postContent ?></p>

                <hr>

                <!-- Blog Comments -->
                <?php include "./includes/post_comments.php" ?>
                
            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php include "./includes/sidebar.php" ?>

        </div>
        <!-- /.row -->

    </div>
    <!-- /.container -->

<?php include "includes/footer.php" ?>
