<?php include "./includes/db.php"; ?>
<?php include "./includes/header.php" ?>
<?php include "./includes/navigation.php" ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">

                <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
                </h1>

                <!-- Looped Blog Post -- Logic -->
                <?php
                    $publishedCounter = 0; 
                    $sql = "SELECT * FROM posts";
                    $result = mysqli_query($connection, $sql);
                    
                    while ($record = mysqli_fetch_assoc($result)) {
                        $postId = $record['post_id'];
                        $postAuthor = $record['post_author'];
                        $postContent = $record['post_content'];
                        $postDate = $record['post_date'];
                        $postImage = $record['post_image'];
                        $postTitle = $record['post_title'];
                        $postStatus = $record['post_status'];

                        // Truncate content on homepage (gallery)
                        $postContent = substr($postContent, 0, 345) . "...";

                        // Only display the posts that have the status: published.
                        if($postStatus == 'published') { 
                            $publishedCounter++;
                            ?>

                            <!-- Looped Blog Post -- Content -->
                            <h2>
                                <a href="post.php?p_id= <?= $postId ?> "><?= $postTitle ?></a>
                            </h2>
                            <p class="lead">
                                by <a href="index.php"><?= $postAuthor ?></a>
                            </p>
                            <p><span class="glyphicon glyphicon-time"></span> Posted on <?= $postDate ?> </p>
                            <hr>
                            <img class="img-responsive" src="./images/<?= $postImage ?>" alt="">
                            <hr>
                            <p><?= $postContent ?></p>
                            <a class="btn btn-primary" href="post.php?p_id= <?= $postId ?> ">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                            <hr>

                        <?php }
                        }
                    if(!$publishedCounter) {
                        echo "<h5>There are no posts available.</h5>";
                    }    
                ?>

                <!-- Pager -->
                <ul class="pager">
                    <li class="previous">
                        <a href="#">&larr; Older</a>
                    </li>
                    <li class="next">
                        <a href="#">Newer &rarr;</a>
                    </li>
                </ul>

            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php include "./includes/sidebar.php" ?>

        </div>
        <!-- /.row -->

    </div>
    <!-- /.container -->

<?php include "./includes/footer.php" ?>
