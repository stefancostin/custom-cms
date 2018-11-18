<?php
    $sql_first_column = "SELECT * FROM categories LIMIT 4";
    $select_categories_first_column = mysqli_query($connection, $sql_first_column);

    $sql_second_column = "SELECT * FROM categories LIMIT 4 OFFSET 4";
    $select_categories_second_column = mysqli_query($connection, $sql_second_column);
?>

<!-- Blog Sidebar Widgets Column -->
<div class="col-md-4">

    <!-- Blog Search Well -->
    <div class="well">
        <h4>Blog Search</h4>
        <form action="search.php" method="post">
            <div class="input-group">
                <input type="text" class="form-control" name="search" placeholder="Search">
                <span class="input-group-btn">
                    <button class="btn btn-default" type="submit" name="submit" value="Submit">
                        <span class="glyphicon glyphicon-search"></span>
                </button>
                </span>
            </div>
        </form>
    </div>

    <!-- Login -->
    <div class="well">
        <h4>Login</h4>
        <form action="includes/login.php" method="post">
            <div class="form-group">
                <label for="username" class="text-gray small-print to-uppercase weight-normal">Username</label>
                <input type="text" class="form-control" id="username" name="username" placeholder="Enter username">
            </div>
            <div class="form-group">
                <label for="password" class="text-gray small-print to-uppercase weight-normal">Password</label>
                <div class="input-group">
                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter password">
                    <span class="input-group-btn">
                        <button class="btn btn-primary" type="submit" name="login">Log In</button>
                    </span>
                </div>
            </div>
            <?php 
                $credentialError = '';
                $userRoleValidation = '';
                if(isset($_SESSION['credentialValidation'])) {                    
                    if($_SESSION['credentialValidation'] === true) {
                        $credentialError = "Invalid credentials.";
                    } elseif($_SESSION['userRoleValidation'] === true) {
                        $userRoleValidation = "Welcome " . $_SESSION['username'] . "! (user)";
                    } else {
                        $credentialError = '';
                        $userRoleValidation = '';
                    }
                }
            ?>
            <p class="action-danger"> <?= $credentialError ?> </p>
            <p class="text-gray"> <?= $userRoleValidation ?> </p>
            <?php 
                // Reset credential validation after changing page
                // in order to get rid of permanent credential error.
                $_SESSION['credentialValidation'] = false; 
                $_SESSION['userRoleValidation'] = false; 
            ?>
        </form>
    </div>

    <!-- Blog Categories Well -->
    <div class="well">
        <h4>Blog Categories</h4>
        <div class="row">
            <div class="col-lg-6">
                <ul class="list-unstyled">
                    <?php
                        while ($record = mysqli_fetch_assoc($select_categories_first_column)) { ?>          
                            <li>
                                <a href="category.php?category= <?= $record['cat_id'] ?> "><?= $record['cat_title'] ?></a>
                            </li>
                        <?php }
                    ?>
                </ul>
            </div>
            <!-- /.col-lg-6 -->
            <div class="col-lg-6">
                <ul class="list-unstyled">
                    <?php
                        while ($record = mysqli_fetch_assoc($select_categories_second_column)) { ?>          
                            <li>
                                <a href="category.php?category= <?= $record['cat_id'] ?> "><?= $record['cat_title'] ?></a>
                            </li>
                        <?php }
                    ?>
                </ul>
            </div>
            <!-- /.col-lg-6 -->
        </div>
        <!-- /.row -->
    </div>

    <!-- Side Widget Well -->
    <?php include "widget.php"; ?>

</div>