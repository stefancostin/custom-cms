<?php include "./includes/admin_header.php"; ?>

    <div id="wrapper">

        <!-- Navigation -->
        <?php include "./includes/admin_navigation.php" ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome to Admin
                            <small>Subheading</small>
                        </h1>
                        <?php
                            $input_empty_error = "";
                            if(isset($_POST['submit'])) {
                                // Deconstructing superglobal.
                                $category_title = $_POST['cat_title'];
                                // Checking if string is empty.
                                if($category_title == "" || empty($category_title)) {
                                    // Displaying this under Submit.
                                    $input_empty_error = "This field should not be empty.";
                                } else {
                                    // Security against SQL Injections.
                                    $category_title = mysqli_real_escape_string($connection, $category_title);
                                    // Staging query to DB.
                                    $sql = "INSERT INTO categories(cat_title) VALUES ('$category_title')";
                                    // Executing query.
                                    $query = mysqli_query($connection, $sql);
                                    // Validating query.
                                    if(!$query) {
                                        die("Query Failed " . mysqli_error());
                                    }
                                }
                            }
                        ?>
                        <!-- left column -->
                        <div class="col-xs-6">                     
                            <form action="" method="post">
                                <div class="form-group">
                                    <label for="cat_title">Add Category</label>
                                    <input type="text" class="form-control" name="cat_title" id="cat_title">
                                </div>
                                <input type="submit" class="btn btn-primary" name="submit" value="Add Category">
                                <p class="error"><?= $input_empty_error ?></p>
                            </form>
                        </div>
                        <!-- /.col-xs-6 -->
                        <?php
                            // Add Category
                            $sql = "SELECT * FROM categories";
                            $select_categories = mysqli_query($connection, $sql);

                            // Delete Category
                            if(isset($_GET['delete'])) {
                                $category_id = $_GET['delete'];
                                $sql = "DELETE FROM categories WHERE cat_id = '$category_id'";
                                $delete_category = mysqli_query($connection, $sql);
                                // Refresh the page:
                                header("Location: categories.php");
                            }
                        ?>
                        <!-- right column -->
                        <div class="col-xs-6">
                            <table class="table table-hover">
                                <thead>       
                                    <tr>
                                        <th>Id</th>
                                        <th>Categories</th>
                                        <th><!--Empty--></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($record = mysqli_fetch_assoc($select_categories)) { ?>
                                    <tr>
                                        <td><?= $record['cat_id'] ?></td>
                                        <td><?= $record['cat_title'] ?></td>
                                        <td><a href="categories.php?delete= <?= $record['cat_id'] ?>" class="action-danger">Delete</a></td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.col-xs-6 -->
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

<?php include "./includes/admin_footer.php" ?>
