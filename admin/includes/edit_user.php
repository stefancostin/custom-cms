<?php 
    // Displaying the user selected to de edited.
    //
    // We first pass the id through a $_GET request,
    // and then we make a query for this specific row to get its data.
    if(isset($_GET['edit']) && $_GET['source'] === 'edit_user') {
        // Initializing variable
        $user_id = $_GET['edit'];

        // Query to DB
        $sql = "SELECT * FROM users WHERE user_id = '$user_id'";
        $select_user_by_id = mysqli_query($connection, $sql);
        validateQuery($select_user_by_id);

        // Retrieving row/record/post with specific ID from DB
        $selected_user = mysqli_fetch_assoc($select_user_by_id);

        // Deconstructing result object
        $firstname = $selected_user['user_firstname'];
        $lastname = $selected_user['user_lastname'];
        $username = $selected_user['user_username'];
        $email = $selected_user['user_email'];
        $role = $selected_user['user_role'];
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

        // die($post_status);

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
                <label for="firstname">First Name</label>
                <input type="text" class="form-control" id="firstname" name="firstname" value="<?= $firstname ?>">
            </div>
            <div class="form-group">
                <label for="post_author">Last Name</label>
                <input type="text" class="form-control" id="post_author" name="lastname" value="<?= $lastname ?>">
            </div>
            <div class="form-group">
                <label for="role">Role</label>
                <select name="role" id="role" class="form-control">
                    <?php if($role === 'admin') { ?>
                        <option value="admin" selected="selected">Admin</option>
                        <option value="subscriber">Subscriber</option>
                    <?php } else { ?>
                        <option value="subscriber">Subscriber</option>
                        <option value="admin">Admin</option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" id="username" name="username" value="<?= $username ?>">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?= $email ?>">
            </div>
            <input type="submit" class="btn btn-primary mb-15" value="Add User" name="add_user">
        </form>
    </div>
</div>