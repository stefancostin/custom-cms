<?php include "./includes/admin_header.php"; ?>
<?php include "./includes/widget.php" ?>
<?php
    // Get number of draft posts to display on chart.
    $sql = "SELECT * FROM posts WHERE post_status = 'draft'";
    $select_draft_posts = mysqli_query($connection, $sql);
    if(!$select_draft_posts) {
        die("QUERY FAILED. " . mysqli_error($connection));
    }
    $draft_posts_count = mysqli_num_rows($select_draft_posts);

    // Get number of published posts to display on chart.
    $sql = "SELECT * FROM posts WHERE post_status = 'published'";
    $select_published_posts = mysqli_query($connection, $sql);
    if(!$select_published_posts) {
        die("QUERY FAILED. " . mysqli_error($connection));
    }
    $published_posts_count = mysqli_num_rows($select_published_posts);

    // Get number of subscribers to display on chart.
    $sql = "SELECT * FROM users WHERE user_role = 'subscriber'";
    $select_user_roles = mysqli_query($connection, $sql);
    if(!$select_user_roles) {
        die("QUERY FAILED. " . mysqli_error($connection));
    }
    $subscriber_count = mysqli_num_rows($select_user_roles);

    // Get number of unapproved comments to display on chart.
    $sql = "SELECT * FROM comments WHERE comment_status = 'unapproved'";
    $select_unapproved_comments = mysqli_query($connection, $sql);
    if(!$select_unapproved_comments) {
        die("QUERY FAILED. " . mysqli_error($connection));
    }
    $unapproved_comment_count = mysqli_num_rows($select_unapproved_comments);
?>

    <div id="wrapper">

        <!-- Navigation -->
        <?php include "./includes/admin_navigation.php" ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12 mb-25">
                        <h1 class="page-header">
                            Welcome to admin
                            <?php if(isset($_SESSION['firstname'])) { ?>
                                <small class="to-capitalized"><?= $_SESSION['firstname'] ?></small>
                            <?php } ?>
                        </h1>

                        <!-- Widgets -->
                        <?php $post_count = showPostsCard(); ?>
                        <?php $category_count = showCommentsCard(); ?>
                        <?php $user_count = showUsersCard(); ?>
                        <?php $comment_count = showCategoriesCard(); ?>   
                    </div>
                </div>
                <!-- /.row -->


                <!-- Google Charts -- Script -->
                <div class="row">
                    <div class="col-lg-12 mb-25">

                        <script type="text/javascript">
                        
                            google.charts.load('current', {'packages':['bar']});
                            google.charts.setOnLoadCallback(drawChart);
                            

                            function drawChart() {

                                var data = google.visualization.arrayToDataTable([
                                ['Year', 'Count'],
                                <?php
                                    $element_text = ['All Posts', 'Active Posts', 'Draft Posts', 'Categories', 'Users', 'Subscribers', 'Comments', 'Pending Comments'];
                                    $element_count = [$post_count, $published_posts_count, $draft_posts_count, $category_count, $user_count, $subscriber_count, $comment_count, $unapproved_comment_count];
                                    for ($i = 0; $i < 8; $i++) {
                                        echo "['{$element_text[$i]}', {$element_count[$i]}],";
                                        // JS Output: ['Active Posts', 120]. ['Categories', 12],
                                    }
                                ?>
                                ]);

                                var options = {
                                chart: {
                                    title: 'Company Performance',
                                    subtitle: 'Sales, Expenses, and Profit: 2018-2019',
                                }
                                };

                                var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

                                chart.draw(data, google.charts.Bar.convertOptions(options));
                            }
                        </script>    
                        <!-- Google Charts -- HTML -->
                        <div id="columnchart_material" class="pl-15 pr-15" style="width:'auto'; height: 500px;"></div>

                    </div>
                </div>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

<?php include "./includes/admin_footer.php" ?>
