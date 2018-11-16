<?php include "./includes/admin_header.php"; ?>
<?php include "./includes/widget.php" ?>

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
                                    $element_text = ['Active Posts', 'Categories', 'Users', 'Comments'];
                                    $element_count = [$post_count, $category_count, $user_count, $comment_count];
                                    for ($i = 0; $i < 4; $i++) {
                                        echo "['{$element_text[$i]}', {$element_count[$i]}],";
                                        // JS Output: ['Active Posts', 120]. ['Categories', 12],
                                    }
                                ?>
                                ]);

                                var options = {
                                chart: {
                                    title: 'Company Performance',
                                    subtitle: 'Sales, Expenses, and Profit: 2014-2017',
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
