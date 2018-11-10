<?php 
    if(isset($_POST['create_comment'])) {
        $comment_author = $_POST['comment_author'];
        $comment_email = $_POST['comment_email'];
        $comment_content = $_POST['comment_content'];

        // Post Comment
        $sql = "INSERT INTO comments (comment_post_id, comment_author, comment_email, comment_content, comment_status, comment_date) VALUES ($post_id, '$comment_author', '$comment_email', '$comment_content', 'unapproved', now())";
        $comment = mysqli_query($connection, $sql);
        if(!$comment) {
            die("QUERY FAILED " . mysqli_error($connection));
        }

        // Increment comment count on 'posts' table
        $sql = "UPDATE posts SET post_comment_count = post_comment_count + 1 WHERE post_id = $post_id";
        $increment_comment_count = mysqli_query($connection, $sql);
        if(!$increment_comment_count) {
            die("QUERRY FAILED " . mysqli_error($connection));
        }

    }
?>

<!-- Blog Comments -->

<!-- Comments Form -->
<div class="well">
    <h4>Leave a Comment:</h4>
    <form role="form" action="" method="post">
        <div class="form-group">
            <label for="comment_author">Author</label>
            <input type="text" class="form-control" name="comment_author" id="comment_author">
        </div>
        <div class="form-group">
            <label for="comment_email">Email</label>
            <input type="email" class="form-control" name="comment_email" id="comment_email">
        </div>
        <div class="form-group">
            <label for="comment_content">Comment</label>
            <textarea class="form-control" rows="3" name="comment_content" id="comment_content"></textarea>
        </div>
        <button type="submit" class="btn btn-primary" name="create_comment">Submit</button>
    </form>
</div>

<hr>

<!-- Posted Comments -->

<!-- Comment -->
<div class="media">
    <a class="pull-left" href="#">
        <img class="media-object" src="http://placehold.it/64x64" alt="">
    </a>
    <div class="media-body">
        <h4 class="media-heading">Start Bootstrap
            <small>August 25, 2014 at 9:30 PM</small>
        </h4>
        Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
    </div>
</div>

<!-- Comment -->
<div class="media">
    <a class="pull-left" href="#">
        <img class="media-object" src="http://placehold.it/64x64" alt="">
    </a>
    <div class="media-body">
        <h4 class="media-heading">Start Bootstrap
            <small>August 25, 2014 at 9:30 PM</small>
        </h4>
        Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
        <!-- Nested Comment -->
        <div class="media">
            <a class="pull-left" href="#">
                <img class="media-object" src="http://placehold.it/64x64" alt="">
            </a>
            <div class="media-body">
                <h4 class="media-heading">Nested Start Bootstrap
                    <small>August 25, 2014 at 9:30 PM</small>
                </h4>
                Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
            </div>
        </div>
        <!-- End Nested Comment -->
    </div>
</div>