<?php 
    // Displaying the post selected to de edited.
    //
    // We first pass the id through a $_GET request,
    // and then we make a query for this specific row to get its data.
    if(isset($_GET['edit']) && $_GET['source'] === 'edit_post') {
        // Initializing variable
        $post_id = $_GET['edit'];

        // Query to DB
        $sql = "SELECT * FROM posts WHERE post_id = '$post_id'";
        $select_post_by_id = mysqli_query($connection, $sql);
        validateQuery($select_post_by_id);

        // Retrieving row/record/post with specific ID from DB
        $selected_post = mysqli_fetch_assoc($select_post_by_id);

        // Deconstructing result object
        $post_title = $selected_post['post_title'];
        $post_author = $selected_post['post_author'];
        $post_category_id = $selected_post['post_category_id'];
        $post_status = $selected_post['post_status'];
        $post_tags = $selected_post['post_tags'];
        $post_content = $selected_post['post_content'];
        $post_image = $selected_post['post_image'];
        $post_comment_count = $selected_post['post_comment_count'];
        $post_date = $selected_post['post_date'];
    }

    // Submit edited information.
    if(isset($_POST['update_post'])) {
        // Deconstructing Post Superglobal.
        $post_title = $_POST['post_title'];
        $post_author = $_POST['post_author'];
        $post_category_id = $_POST['post_category_id'];
        $post_status = $_POST['post_status'];
        $post_tags = $_POST['post_tags'];
        $post_content = $_POST['post_content'];

        $post_image = $_FILES['image']['name'];
        $post_image_temp = $_FILES['image']['tmp_name'];

        $post_comment_count = 4;
        $post_date = date('d-m-y');

        // Escapes 'quotes'. Text sent with quotes fails the insert query.
        $post_content = addslashes($post_content);

        // Uploading Image
        move_uploaded_file($post_image_temp, "../images/$post_image");

        // Binds $post_image to previously sleected image from DB.
        //
        // If we ommit this code then the Update function will look for
        // an image to upload from the $_FILES on the hard drive.
        // This behaviour will upload an empty image address.
        if(empty($post_image)) {
            $sql = "SELECT * FROM posts WHERE post_id = '$post_id'";
            $select_image = mysqli_query($connection, $sql);
            $image_address = mysqli_fetch_assoc($select_image);
            
            $post_image = $image_address['post_image'];
        }

        // Query to DB
        $sql = "UPDATE posts SET post_category_id = '$post_category_id', post_title = '$post_title', post_author = '$post_author', post_date = now(), post_image = '$post_image', post_content = '$post_content', post_tags = '$post_tags', post_comment_count = $post_comment_count, post_status = '$post_status' WHERE post_id = $post_id";

        $update_post = mysqli_query($connection, $sql);

        // Validate Query
        validateQuery($update_post);

        // Redirect
        header("Location: posts.php");
    }
?>
<div class="row">
    <div class="col-sm-6">
        <form action="" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="post_title">Post Title</label>
                <input type="text" class="form-control" id="post_title" name="post_title" value="<?= $post_title ?>">
            </div>
            <div class="form-group">
                <label for="post_category_id">Post Category Id</label>
                <select name="post_category_id" id="post_category_id">
                    <?php 
                        $sql = "SELECT * FROM categories";
                        $select_categories = mysqli_query($connection, $sql);
                                            
                        while($category = mysqli_fetch_assoc($select_categories)) {
                            $category_id = $category['cat_id'];
                            $category_title = $category['cat_title'];

                            // Making the current post the default selected option
                            if ($category_id === $post_category_id) {
                                echo "<option value='{$category_id}' selected='selected'>{$category_title} - Current Category </option>";
                            } else {
                                echo "<option value='{$category_id}'>{$category_title}</option>";
                            }
                        } 
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="post_author">Post Author</label>
                <input type="text" class="form-control" id="post_author" name="post_author" value="<?= $post_author ?>">
            </div>
            <div class="form-group">
                <label for="post_status">Post Status</label>
                <input type="text" class="form-control" id="post_status" name="post_status" value="<?= $post_status ?>">
            </div>
            <div class="form-group">
                <label for="post_image">Post Image</label>
                <img src="../images/<?= $post_image ?>" width="150px" class="d-block mb-10">
                <input type="file" id="image" name="image" value="<?= $post_image ?>">
            </div>
            <div class="form-group">
                <label for="post_tags">Post Tags</label>
                <input type="text" class="form-control" id="post_tags" name="post_tags" value="<?= $post_tags ?>">
            </div>
            <div class="form-group">
                <label for="post_content">Post Content</label>
                <textarea type="text" class="form-control" id="post_content" name="post_content" cols"30" rows="10">
                    <?= $post_content ?>
                </textarea>
            </div>
            <input type="submit" class="btn btn-primary mb-15" value="Submit Post" name="update_post">
        </form>
    </div>
</div>