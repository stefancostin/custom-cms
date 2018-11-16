<?php
    function showPostsCard() {  
        global $connection;      
        $title = 'Posts';
        $color = 'primary';
        $icon = 'fa-clipboard';
        $link = 'posts.php';

        $query = "SELECT * FROM posts";
        $select_posts_query = mysqli_query($connection, $query);
        if(!$select_posts_query) {
            die("Query error: " . mysqli_error($connection));
        }

        $count = mysqli_num_rows($select_posts_query);
        
        widgetTemplate($title, $count, $color, $icon, $link);

        return $count;
    }

    function showCommentsCard() {  
        global $connection;      
        $title = 'Comments';
        $color = 'green';
        $icon = 'fa-comments';
        $link = 'comments.php';

        $query = "SELECT * FROM comments";
        $select_comments_query = mysqli_query($connection, $query);
        if(!$select_comments_query) {
            die("Query error: " . mysqli_error($connection));
        }

        $count = mysqli_num_rows($select_comments_query);
        
        widgetTemplate($title, $count, $color, $icon, $link);

        return $count;
    }

    function showUsersCard() {  
        global $connection;      
        $title = 'Users';
        $color = 'yellow';
        $icon = 'fa-user';
        $link = 'users.php';

        $query = "SELECT * FROM users";
        $select_users_query = mysqli_query($connection, $query);
        if(!$select_users_query) {
            die("Query error: " . mysqli_error($connection));
        }

        $count = mysqli_num_rows($select_users_query);
        
        widgetTemplate($title, $count, $color, $icon, $link);

        return $count;
    }

    function showCategoriesCard() {  
        global $connection;      
        $title = 'Categories';
        $color = 'red';
        $icon = 'fa-list';
        $link = 'categories.php';

        $query = "SELECT * FROM categories";
        $select_categories_query = mysqli_query($connection, $query);
        if(!$select_categories_query) {
            die("Query error: " . mysqli_error($connection));
        }

        $count = mysqli_num_rows($select_categories_query);
        
        widgetTemplate($title, $count, $color, $icon, $link);

        return $count;
    }

    // HTML Template
    function widgetTemplate($title, $counter, $color, $icon, $link) { ?>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-<?= $color ?>">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa <?= $icon ?> fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge"><?= $counter ?></div>
                            <div><?= $title ?></div>
                        </div>
                    </div>
                </div>
                <a href="<?= $link ?>">
                    <div class="panel-footer">
                        <span class="pull-left">View Details</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
    <?php }
?>
