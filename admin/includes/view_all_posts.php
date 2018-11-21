<?php deletePost(); ?>
<?php publishPost(); ?>
<?php bulkAction(); ?>
<form action="" method="post">
    <!-- Bulk Action Commands -->
    <div class="row mb-15">
        <div id="bulkOptionsContainer" class="col-xs-12 text-right">
            <select class="form-control d-inline-block" style="max-width: 200px" name="bulk_options">
                <option value="">Select Options</option>
                <option value="published">Publish</option>
                <option value="draft">Draft</option>
                <option value="clone">Clone</option>
                <option value="reset">Reset Views</option>
                <option value="delete">Delete</option>
            </select>
            <input type="submit" name="submit" class="btn btn-success ml-5" value="Apply">
            <a href="posts.php?source=add_post" class="btn btn-primary">Add New</a>
        </div>
    </div>
    <!-- Posts Table -->
    <table class="table table-hover table-bordered">
        <thead>
            <tr>
                <th><input type="checkbox" id="selectAllBoxes"></th>
                <th>Id</th>
                <th>Author</th>
                <th>Title</th>
                <th>Category</th>
                <th>Status</th>
                <th>Image</th>
                <th>Tags</th>
                <th>Comments</th>
                <th>Date</th>
                <th>Views</th>
                <!-- Actions -->
                <th>View</th>
                <th>Publish</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            <?php showAllPosts(); ?>
        </tbody>
    </table>
</form>