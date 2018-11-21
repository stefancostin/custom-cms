<?php include "./includes/db.php"; ?>
<?php include "./includes/header.php" ?>
<?php
    // Pagination
    $per_page = 5;
    if(isset($_GET['page'])) {
        $page = $_GET['page'];
        if($page == "") {
            $post = 0;
        } else {
            $post = $per_page * ($page - 1);
        }
    } else {
        $page = 1;
        $post = 0;
    }
?>

    <!-- Navigation -->
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

                <!-- Pagination - Getting total nubmer of published posts -->
                <?php
                    $sql = "SELECT * FROM posts WHERE post_status = 'published'";
                    $get_number_of_posts = mysqli_query($connection, $sql);
                    $post_count = mysqli_num_rows($get_number_of_posts);
                    // Establishing number of pages (page_count)
                    $page_count = ceil($post_count / $per_page);
                ?>

                <!-- Looped Blog Post -- Logic -->
                <?php
                    $publishedCounter = 0; 
                    $sql = "SELECT * FROM posts LIMIT $post, $per_page";
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
                                by <a href="author.php?author=<?= $postAuthor ?>"><?= $postAuthor ?></a>
                            </p>
                            <p><span class="glyphicon glyphicon-time"></span> Posted on <?= $postDate ?> </p>
                            <hr>
                            <a href="post.php?p_id= <?= $postId ?> "><img class="img-responsive" src="./images/<?= $postImage ?>" alt=""></a>
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
                    <!-- Previous Page -->
                    <?php 
                        if($page > 1) { ?>
                            <li class="previous">
                                <a href="index.php?page=<?=$page - 1?>">&larr; Older</a>
                            </li>
                        <?php } else { ?>
                            <li class="previous">
                                <a class="disabled">&larr; Older</a>
                            </li>
                        <?php }
                    ?>
                    <!-- Page Counter -->
                    <?php
                        for($i = 1; $i <= $page_count; $i++) {
                            if($i == $page) { ?>
                                <li>
                                    <a href="index.php?page=<?=$i?>" class="active"><?= $i ?></a>
                                </li>
                            <?php } else { ?>
                                <li>
                                    <a href="index.php?page=<?=$i?>"><?= $i ?></a>
                                </li>
                        <?php }
                        }
                    ?>
                    <!-- Next Page -->
                    <?php 
                        if($page < $page_count) { ?>
                            <li class="next">
                                <a href="index.php?page=<?=$page + 1?>">Newer &rarr;</a>
                            </li>
                        <?php } else { ?>
                            <li class="next">
                                <a class="disabled">Newer &rarr;</a>
                            </li>
                        <?php }
                    ?>
                </ul>

            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php include "./includes/sidebar.php" ?>

        </div>
        <!-- /.row -->

    </div>
    <!-- /.container -->

<?php include "./includes/footer.php" ?>
