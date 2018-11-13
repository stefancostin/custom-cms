<?php
    /* CATEGORIES
     * =================================================== */
    function addCategory() {
        global $connection;
        global $input_empty_error;

        $input_empty_error = "";

        if(isset($_POST['submit'])) {
            $category_title = $_POST['cat_title'];
    
            if($category_title == "" || empty($category_title)) {
                $input_empty_error = "This field should not be empty.";
            } else {
                $category_title = mysqli_real_escape_string($connection, $category_title);
                $sql = "INSERT INTO categories (cat_title) VALUES ('$category_title')";
                $query = mysqli_query($connection, $sql);
                if(!$query) {
                    die("Query Failed " . mysqli_error($connection));
                }
            }
        }
    }

    function showAllCategories() {
        global $connection;
        global $select_categories;

        $sql = "SELECT * FROM categories";
        $select_categories = mysqli_query($connection, $sql);
    }

    function updateCategory() {
        global $connection;
        global $edit_category_id;
        global $edit_category_title;

        if(isset($_GET['edit_id']) && isset($_GET['edit_title'])) {
            $edit_category_id = $_GET['edit_id'];
            $edit_category_title = $_GET['edit_title'];
    
            if(isset($_POST['edit'])) {
                $update_category = $_POST['update_category'];
                $sql = "UPDATE categories SET cat_title = '$update_category' WHERE cat_id = '$edit_category_id'";
                $edit_category = mysqli_query($connection, $sql);
                // Refresh the page:
                header("Location: categories.php");
            }
        }
    }

    function deleteCategory() {
        global $connection;

        if(isset($_GET['delete'])) {
            $category_id = $_GET['delete'];
            $sql = "DELETE FROM categories WHERE cat_id = '$category_id'";
            $delete_category = mysqli_query($connection, $sql);
            // Refresh the page:
            header("Location: categories.php");
        }
    }

    /* POSTS
     * =================================================== */
    function showAllPosts() {
        global $connection;

        $sql = "SELECT * FROM posts ORDER BY FIELD (post_status, 'draft', 'published')";
        $selected_posts = mysqli_query($connection, $sql);
        validateQuery($selected_posts);

        while ($record = mysqli_fetch_assoc($selected_posts)) { 
        ?>
            <tr>
                <td><?= $record['post_id'] ?></td>
                <td><?= $record['post_author'] ?></td>
                <td><?= $record['post_title'] ?></td>
                <td><?= getCategoryById($record['post_category_id']); ?></td>
                <td><?= $record['post_status'] ?></td>
                <td><img src="../images/<?=$record['post_image']?>" class="img-responsive"></td>
                <td><?= $record['post_tags'] ?></td>
                <td><?= $record['post_comment_count'] ?></td>
                <td>1<?= $record['post_date'] ?></td>
                <!-- Actions -->
                <?php if($record['post_status'] !== 'published') { ?>
                    <td><a href="?publish=<?=$record['post_id']?>">Publish</a></td>
                <?php } else { ?>
                    <td class="text-gray">Publish</td>                    
                <?php } ?>
                <td><a href="?source=edit_post&edit=<?=$record['post_id']?>">Edit</a></td>
                <td><a href="?delete=<?=$record['post_id']?>" class="action-danger">Delete</a></td>
            </tr>        
        <?php
        }
    }

    function deletePost() {
        global $connection;

        if(isset($_GET['delete'])) {
            $post_id = $_GET['delete'];

            $sql = "DELETE FROM posts WHERE post_id = '$post_id'";
            $delete_post = mysqli_query($connection, $sql);
            validateQuery($delete_post);
        }
    }

    function publishPost() {
        global $connection;

        if(isset($_GET['publish'])) {
            $post_id = $_GET['publish'];

            $sql = "UPDATE posts SET post_status = 'published' WHERE post_id = $post_id";
            $publish_post = mysqli_query($connection, $sql);
            validateQuery($publish_post);
        } 
    }


    /* COMMENTS
     * =================================================== */
    function showAllComments() {
        global $connection;

        // Getting comments from DB.
        $sql = "SELECT * FROM comments";
        $selected_comments = mysqli_query($connection, $sql);
        validateQuery($selected_comments);

        while ($record = mysqli_fetch_assoc($selected_comments)) { 
            // Getting post_title from 'posts'
            $sql = "SELECT * FROM posts WHERE post_id = '{$record['comment_post_id']}'";
            $get_post = mysqli_query($connection, $sql);
            $selected_post = mysqli_fetch_assoc($get_post);
            $post_title = $selected_post['post_title'];
            $post_id = $selected_post['post_id'];
        ?>
            <tr>
                <td><?= $record['comment_id'] ?></td>
                <td><?= $record['comment_author'] ?></td>
                <td><?= $record['comment_content'] ?></td>
                <td><?= $record['comment_email'] ?></td>
                <td><?= $record['comment_status'] ?></td>
                <td><a href="../post.php?p_id= <?= $post_id ?>"><?= $post_title ?></a></td>
                <td><?= $record['comment_date'] ?></td>
                <!-- Actions -->
                <td><a href="?approve= <?= $record['comment_id'] ?>">Approve</a></td>
                <td><a href="?unapprove= <?= $record['comment_id'] ?>" class="action-danger">Unapprove</a></td>
                <td><a href="?delete= <?= $record['comment_id'] ?> & post_id= <?= $record['comment_post_id'] ?>" class="action-danger">Delete</a></td>
            </tr>        
        <?php
        }
    }

    function deleteComment() {
        global $connection;

        if(isset($_GET['delete'])) {
            $comment_id = $_GET['delete'];

            $sql = "DELETE FROM comments WHERE comment_id = '$comment_id'";
            $delete_comment = mysqli_query($connection, $sql);
            validateQuery($delete_comment);

            
            // We also need to de-increment post_comment_count,
            // or the number of comments per post, stored in the 'posts' table.
            $comment_post_id = $_GET['post_id'];

            $sql = "UPDATE posts SET post_comment_count = post_comment_count - 1 WHERE post_id = $comment_post_id";
            $deincrement_post_comment_count = mysqli_query($connection, $sql);
            validateQuery($deincrement_post_comment_count);
        }
    }

    function checkCommentStatus() {
        global $connection;

        if(isset($_GET['approve'])) {
            $comment_id = $_GET['approve'];
            $comment_status = 'approved';
            setCommentStatus($comment_id, $comment_status);
        }
        elseif(isset($_GET['unapprove'])) {
            $comment_id = $_GET['unapprove'];
            $comment_status = 'unapproved';
            setCommentStatus($comment_id, $comment_status);
        }
    }

    function setCommentStatus($comment_id, $comment_status) {
        global $connection;
        
        $sql = "UPDATE comments SET comment_status = '$comment_status' WHERE comment_id = '$comment_id'";
        $change_status = mysqli_query($connection, $sql);
        validateQuery($change_status);
    }



    /* USERS
     * =================================================== */
    function showAllUsers() {
        global $connection;

        $sql = "SELECT * FROM users";
        $selected_users = mysqli_query($connection, $sql);
        validateQuery($selected_users);

        while ($record = mysqli_fetch_assoc($selected_users)) { 
        ?>
            <tr>
                <td><?= $record['user_id'] ?></td>
                <td><?= $record['user_username'] ?></td>
                <td><?= $record['user_firstname'] ?></td>
                <td><?= $record['user_lastname'] ?></td>
                <td><?= $record['user_email'] ?></td>
                <td><?= $record['user_role'] ?></td>
                <!-- Actions -->
                <td><a href="?source=edit_user&edit=<?=$record['user_id']?>">Edit</a></td>
                <td><a href="?delete=<?=$record['user_id']?>" class="action-danger">Delete</a></td>
            </tr>        
        <?php
        }
    }

    function deleteUser() {
        global $connection;

        if(isset($_GET['delete'])) {
            $user_id = $_GET['delete'];

            $sql = "DELETE FROM users WHERE user_id = '$user_id'";
            $delete_user = mysqli_query($connection, $sql);
            validateQuery($delete_user);
        }
    }




    /* UTILITY
     * =================================================== */
    function validateQuery($result_object) {
        global $connection;

        if(!$result_object) {
            die("QUERY FAILED. " . mysqli_error($connection));
        }
    }

    function getCategoryById($category_id) {
        global $connection;

        $sql = "SELECT * FROM categories WHERE cat_id = '$category_id'";
        $get_category_by_id = mysqli_query($connection, $sql);
        validateQuery($get_category_by_id);

        $selected_category = mysqli_fetch_assoc($get_category_by_id);

        $category_title = $selected_category['cat_title'];
        return $category_title;
    }

?>