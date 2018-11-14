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
    if(isset($_POST['update_user'])) {
        // Deconstructing Post Superglobal.
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $role = $_POST['role'];
        $username = $_POST['username'];
        $email = $_POST['email'];

        // Query to DB
        $sql = "UPDATE users SET user_firstname = '$firstname', user_lastname = '$lastname', user_role = '$role', user_username = '$username', user_email = '$email' WHERE user_id = $user_id";
        $update_user = mysqli_query($connection, $sql);

        // Validate Query
        validateQuery($update_user);

        // Redirect
        header("Location: users.php");
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
            <input type="submit" class="btn btn-primary mb-15" value="Edit User" name="update_user">
        </form>
    </div>
</div>