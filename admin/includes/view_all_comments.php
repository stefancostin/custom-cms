<?php deleteComment(); ?>
<?php checkCommentStatus(); ?>

<table class="table table-hover table-bordered">
    <thead>
        <tr>
            <th>Id</th>
            <th>Author</th>
            <th>Comment</th>
            <th>Email</th>
            <th>Status</th>
            <th>In Response To</th>
            <th>Date</th>
            <!-- Actions -->
            <th>Approve</th>
            <th>Unnaprove</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
        <?php showAllComments(); ?>
    </tbody>
</table>