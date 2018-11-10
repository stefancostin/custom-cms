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
    <?php include "widget.html"; ?>

</div>