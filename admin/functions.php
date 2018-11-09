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
                $sql = "INSERT INTO categories(cat_title) VALUES ('$category_title')";
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

        $sql = "SELECT * FROM posts";
        $selected_posts = mysqli_query($connection, $sql);
        validateQuery($selected_posts);

        while ($record = mysqli_fetch_assoc($selected_posts)) { 
        ?>
            <tr>
                <td><?= $record['post_id'] ?></td>
                <td><?= $record['post_author'] ?></td>
                <td><?= $record['post_title'] ?></td>
                <td><?= $record['post_category_id'] ?></td>
                <td><?= $record['post_status'] ?></td>
                <td><img src="../images/<?=$record['post_image']?>" class="img-responsive"></td>
                <td><?= $record['post_tags'] ?></td>
                <td><?= $record['post_comment_count'] ?></td>
                <td>1<?= $record['post_date'] ?></td>
                <!-- Actions -->
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
            // Refresh the page:
            // header("Location: posts.php");
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

?>