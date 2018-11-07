<?php include "./includes/admin_header.php"; ?>
<?php include "functions.php"; ?>
<?php
    addCategory();
    showAllCategories();
    updateCategory();
    deleteCategory();
?>

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
                        <div class="col-xs-6">                     
                            <form action="" method="post" class="mb-40">
                                <div class="form-group">
                                    <label for="cat_title">Add Category</label>
                                    <input type="text" class="form-control" name="cat_title" id="cat_title">
                                </div>
                                <input type="submit" class="btn btn-primary" name="submit" value="Add Category">
                                <p class="error"><?= $input_empty_error ?></p>
                            </form>
                            <?php if(isset($_GET['edit_id']) && isset($_GET['edit_title'])) { ?>
                                <hr>
                                <form action="" method="post" class="mt-20">
                                    <div class="form-group">
                                        <label for="update_category">Edit<span><?= $edit_category_title ?></span></label>
                                        <input type="text" class="form-control" name="update_category" id="update_category" value="<?= $edit_category_title ?>">
                                    </div>
                                    <input type="submit" class="btn btn-primary" name="edit" value="Edit Category">
                                    <p class="error"><?= $input_empty_error ?></p>
                                </form>
                            <?php } ?>
                        </div>
                        <!-- /.col-xs-6 -->
                        <div class="col-xs-6">
                            <table class="table table-hover">
                                <thead>       
                                    <tr>
                                        <th>Id</th>
                                        <th>Categories</th>
                                        <th><!--Empty--></th>
                                        <th><!--Empty--></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($record = mysqli_fetch_assoc($select_categories)) { ?>
                                    <tr>
                                        <td><?= $record['cat_id'] ?></td>
                                        <td><?= $record['cat_title'] ?></td>
                                        <td><a href="categories.php?edit_id= <?= $record['cat_id'] ?> &edit_title= <?= $record['cat_title'] ?>">Edit</a></td>
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
