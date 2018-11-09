<?php deletePost() ?>

<table class="table table-hover">
    <thead>
        <tr>
            <th>Id</th>
            <th>Author</th>
            <th>Title</th>
            <th>Category</th>
            <th>Status</th>
            <th>Image</th>
            <th>Tags</th>
            <th>Comments</th>
            <th>Date</th>
            <th><!-- Delete --></th>
        </tr>
    </thead>
    <tbody>
        <?php showAllPosts(); ?>
    </tbody>
</table>