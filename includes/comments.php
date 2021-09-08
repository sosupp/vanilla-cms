<?php 

    if ( isset($_POST['create_comment']))
    {
        // set and get values submitted
        $post_id = $_GET['p_id'];
        $author = $_POST['comment_author'];
        $email = $_POST['comment_email'];
        $comment = $_POST['comment_content'];


        // query statement
        $query = "INSERT INTO comments(comment_post_id, comment_author, comment_email, comment_content, comment_status, comment_date)";
        $query .= " VALUES ($post_id , '{$author}', '{$email}', '{$comment}', 'unapproved', now() )";

        // Connect and send query to DB
        $add_comment = mysqli_query($connection, $query);

        if(! $add_comment){
            die('QUERY FAILED' . mysqli_error($connection));
        }


        // update comment count on post table
        $comment_count_query = "UPDATE posts SET post_comment_count = post_comment_count + 1 ";
        $comment_count_query .= "WHERE id = $post_id ";

            // send query to DB
            $update_comment_count = mysqli_query($connection, $comment_count_query);
    }

    // showing comment
        // query statement
        $query = "SELECT * FROM comments WHERE comment_post_id = $post_id ";
        $query .= "AND comment_status = 'approved' ";
        $query .= "ORDER BY comment_id DESC ";

        // send query to DB
        $select_comment = mysqli_query($connection, $query);
 
        if(!$select_comment){
            die('Query Failed'. mysqli_error($connection));
        }

        // Get result and loop
        while ($row = mysqli_fetch_array($select_comment)){
            $comment_date = $row['comment_date'];
            $comment_author = $row['comment_author'];
            $comment_body = $row['comment_content'];
        }


?>



<div class="well">
    <h4>Leave a Comment</h4>


    <form action="" method="POST">
        <div class="role" id="form">

            <div class="form-group">
                <label for="Author">Author</label>
                <input type="text" class="form-control" name="comment_author">
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" name="comment_email">
            </div>

            <div class="form-group">
                <label for="Author">Author</label>
                <div>
                    <textarea name="comment_content" id="" cols="30" rows="10" class="form-control"></textarea>
                </div>
                
            </div>

            <button type="submit" name="create_comment" class="btn btn-primary">Add Comment</button>

        </div>
    </form>
    
</div>