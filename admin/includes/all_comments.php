<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Author</th>
            <th>Comment</th>
            <th>Email</th>
            <th>Status</th>
            <th>Related Post</th>
            <th>Approve</th>
            <th>Unapprove</th>
            <th>Delete</th>
            <th>Date</th>
        </tr>
    </thead>


    <tbody>
        <?php delete_comment() ?>
        <?php approve_comment() ?>
        <?php unapprove_comment() ?>
        <?php comment_list() ?>
        
    </tbody>
</table>    