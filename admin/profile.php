<?php include "./includes/admin_header.php"; ?>
<?php include "functions.php"; ?>
<?php changePassword(); ?>
<?php
    if(isset($_SESSION['username'])) {
        $username = $_SESSION['username'];
        // Query to DB
        $sql = "SELECT * FROM users WHERE user_username = '$username'";
        $select_user_profile = mysqli_query($connection, $sql);
        validateQuery($select_user_profile);

        // Retrieving row/record/post with specific ID from DB
        $profile = mysqli_fetch_assoc($select_user_profile);

        // Deconstructing result object
        $id = $profile['user_id'];
        $firstname = $profile['user_firstname'];
        $lastname = $profile['user_lastname'];
        $username = $profile['user_username'];
        $email = $profile['user_email'];
        $role = $profile['user_role'];
    }

    // Submit edited information.
    if(isset($_POST['update_profile'])) {
        // Deconstructing Post Superglobal.
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $role = $_POST['role'];
        $username = $_POST['username'];
        $email = $_POST['email'];

        // Query to DB
        $sql = "UPDATE users SET user_firstname = '$firstname', user_lastname = '$lastname', user_role = '$role', user_username = '$username', user_email = '$email' WHERE user_id = $id";
        $update_profile = mysqli_query($connection, $sql);

        // Validate Query
        validateQuery($update_profile);

        // Redirect
        // header("Location: users.php");
    }
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

                        <!-- Profile -->
                        <div class="row">
                            <div class="col-sm-6">
                                <h2 class="mb-20">Profile</h2>
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
                                    <input type="submit" class="btn btn-primary mb-15" value="Update Profile" name="update_profile">
                                </form>
                                <hr>
                                <h2 class="mb-20">Change Password</h2>
                                <form action="" method="post">
                                    <div class="form-group">
                                        <label for="current_password">Current Password</label>
                                        <input type="password" class="form-control" id="current_password" name="current_password" placeholder="Your current password">
                                    </div>
                                    <div class="form-group">
                                        <label for="new_password">New Password</label>
                                        <input type="password" class="form-control" id="new_password" name="new_password" placeholder="Your current password">
                                    </div>
                                    <div class="form-group">
                                        <label for="confirm-password">Confirm Password</label>
                                        <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirm your current password">
                                    </div>
                                    <input type="submit" class="btn btn-primary mb-15" name="change_password" value="Change Password">
                                </form>
                            </div>
                        </div>
                        <!-- /profile-row -->

                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

<?php include "./includes/admin_footer.php" ?>
