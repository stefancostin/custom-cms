<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">CMS Front</a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <?php
                    $sql = "SELECT * FROM categories";
                    $select_categories = mysqli_query($connection, $sql);
                    while ($record = mysqli_fetch_assoc($select_categories)) {
                        echo "<li><a href='#'> {$record['cat_title']} </a></li>";
                    }
                ?>
                <li>
                    <a href="admin">Admin</a>
                </li>
                <?php
                    if(isset($_SESSION['role'])) {
                        if(isset($_GET['p_id'])) { ?>
                            <li>
                                <a href="admin/posts.php?source=edit_post&edit= <?= $_GET['p_id'] ?>">Edit Post</a>
                            </li>
                        <?php }
                    }
                ?>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>