<?php 
    if(isset($_POST['create_post'])) {
        // Deconstructing Post Superglobal.
        $post_title = $_POST['post_title'];
        $post_author = $_POST['post_author'];
        $post_category_id = $_POST['post_category_id'];
        $post_status = $_POST['post_status'];
        $post_tags = $_POST['post_tags'];
        $post_content = $_POST['post_content'];

        $post_image = $_FILES['image']['name'];
        $post_image_temp = $_FILES['image']['tmp_name'];

        // $post_comment_count = 4;
        $post_date = date('d-m-y');

        // Uploading Image
        move_uploaded_file($post_image_temp, "../images/$post_image");

        // Query to DB
        $sql = "INSERT INTO posts (post_category_id, post_title, post_author, post_date, post_image, post_content, post_tags, post_status) VALUES ($post_category_id, '$post_title', '$post_author', now(), '$post_image', '$post_content', '$post_tags', '$post_status')";
        $create_post = mysqli_query($connection, $sql);

        // Validate Query
        validateQuery($create_post);
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
                <div class="form-group input-group input-group-btn">
                    <input type="text" class="form-control" id="role" name="role" data-toggle="dropdown" aria-expanded="false">
                    <ul class="dropdown-menu dropdown-menu-left full-width" role="menu">
                        <?php 
                            $sql = "SELECT user_role FROM users";
                            $user_role_query = mysqli_query($connection, $sql);
                            validateQuery($user_role_query);

                            while($user_role = mysqli_fetch_assoc($user_role_query)) { ?>
                                <li><a href="javascript:;"><?= $user_role['user_role'] ?></a></li>
                            <?php } 
                        ?>
                    </ul>
                </div>
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
        <script type="text/javascript" src="./js/jquery.js"></script>
        <script type="text/javascript" src="./includes/user_roles.js"></script>
    </div>
</div>