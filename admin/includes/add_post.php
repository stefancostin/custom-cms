<?php 
    $showAlert = false;
    include "includes/alert.php";
?>
<?php 
    if(isset($_POST['create_post'])) {
        // Deconstructing Post Superglobal.
        $post_title = mysqli_real_escape_string($connection, $_POST['post_title']);
        $post_author = mysqli_real_escape_string($connection, $_POST['post_author']);
        $post_category_id = mysqli_real_escape_string($connection, $_POST['post_category_id']);
        $post_status = mysqli_real_escape_string($connection, $_POST['post_status']);
        $post_tags = mysqli_real_escape_string($connection, $_POST['post_tags']);
        $post_content = mysqli_real_escape_string($connection, $_POST['post_content']);

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

        // Show alert
        if($create_post) {
            // Extract the last created id.
            $last_post_id = mysqli_insert_id($connection);
            $showAlert = true;
        }
    }
?>
<div class="row">
    <div class="col-sm-6">
        <!-- Success Alert -->
        <?php 
            if($showAlert) {
                $moreContent = "<a href='../post.php?p_id=" . $last_post_id . "'>View Post</a> or <a href='posts.php'>Edit More</a>";
                displaySuccessAlert("Post created", $moreContent); 
            }
        ?>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="post_title">Post Title</label>
                <input type="text" class="form-control" id="post_title" name="post_title">
            </div>
            <div class="form-group">
                <label for="post_category_id">Post Category Id</label>
                <select name="post_category_id" id="post_category_id" class="d-block">
                    <?php 
                        $sql = "SELECT * FROM categories";
                        $select_categories = mysqli_query($connection, $sql);
                                            
                        while($category = mysqli_fetch_assoc($select_categories)) {
                            $category_id = $category['cat_id'];
                            $category_title = $category['cat_title'];

                            echo "<option value='{$category_id}'>{$category_title}</option>";
                        } 
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="post_author">Post Author</label>
                <input type="text" class="form-control" id="post_author" name="post_author">
            </div>
            <div class="form-group">
                <label for="post_status">Post Status</label>
                <select class="form-control" name="post_status" id="post_status">
                        <option value="draft" selected="selected">Draft</option>
                        <option value="published">Publish</option>
                </select>
            </div>
            <div class="form-group">
                <label for="post_image">Post Image</label>
                <input type="file" id="image" name="image">
            </div>
            <div class="form-group">
                <label for="post_tags">Post Tags</label>
                <input type="text" class="form-control" id="post_tags" name="post_tags">
            </div>
            <div class="form-group">
                <label for="post_content">Post Content</label>
                <textarea type="text" class="form-control" id="post_content" name="post_content" cols"30" rows="10"></textarea>
            </div>
            <input type="submit" class="btn btn-primary mb-15" value="Submit Post" name="create_post">
        </form>
    </div>
</div>