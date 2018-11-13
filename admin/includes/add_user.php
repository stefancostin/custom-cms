<?php 
    if(isset($_POST['add_user'])) {
        // Deconstructing Post Superglobal.
        $email = $_POST['email'];
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $password = $_POST['password'];
        $role = $_POST['role'];
        $username = $_POST['username'];

        // $post_image = $_FILES['image']['name'];
        // $post_image_temp = $_FILES['image']['tmp_name'];
        // $post_date = date('d-m-y');


        // Uploading Image
        // move_uploaded_file($post_image_temp, "../images/$post_image");

        // Security - Blowfish Salt
        $hashFormat = "$2y$10$";
        $hashRandom = "19601611lamultianiRita";
        $hashSalt = $hashFormat . $hashRandom;
        // Security - Encrypt password
        $password = crypt($password, $hashSalt);

        // Query to DB
        $sql = "INSERT INTO users (user_email, user_firstname, user_lastname, user_password, user_role, user_username) VALUES ('$email', '$firstname', '$lastname', '$password', '$role', '$username')";
        $create_user = mysqli_query($connection, $sql);

        // Validate Query
        validateQuery($create_user);
    }
?>

<div class="row">
    <div class="col-sm-6">
        <form action="" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="firstname">First Name</label>
                <input type="text" class="form-control" id="firstname" name="firstname">
            </div>
            <div class="form-group">
                <label for="post_author">Last Name</label>
                <input type="text" class="form-control" id="post_author" name="lastname">
            </div>
            <div class="form-group">
                <label for="role">Role</label>
                <select name="role" id="role" class="form-control">
                    <option value="subscriber">Subscriber</option>
                    <option value="admin">Admin</option>
                </select>
            </div>

            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" id="username" name="username">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email">
            </div>
            <div class="form-group">
                <label for="passord">Password</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>
            <input type="submit" class="btn btn-primary mb-15" value="Add User" name="add_user">
        </form>
    </div>
</div>