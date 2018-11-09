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

        $post_comment_count = 4;
        $post_date = date('d-m-y');

        // Uploading Image
        move_uploaded_file($post_image_temp, "../images/$post_image");

        // Query to DB
        $sql = "INSERT INTO posts(post_category_id, post_title, post_author, post_date, post_image, post_content, post_tags, post_comment_count, post_status) VALUES ($post_category_id, '$post_title', '$post_author', now(), '$post_image', '$post_content', '$post_tags', $post_comment_count, '$post_status')";

        $create_post = mysqli_query($connection, $sql);

        // Validate Query
        validateQuery($create_post);
    }
?>
<div class="row">
    <div class="col-sm-6">
        <form action="" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="post_title">Post Title</label>
                <input type="text" class="form-control" id="post_title" name="post_title">
            </div>
            <div class="form-group">
                <label for="post_category_id">Post Category Id</label>
                <input type="text" class="form-control" id="post_category_id" name="post_category_id">
            </div>
            <div class="form-group">
                <label for="post_author">Post Author</label>
                <input type="text" class="form-control" id="post_author" name="post_author">
            </div>
            <div class="form-group">
                <label for="post_status">Post Status</label>
                <input type="text" class="form-control" id="post_status" name="post_status">
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