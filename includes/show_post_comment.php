<?php 

    // showing comment
        // query statement
        $query = "SELECT * FROM comments WHERE comment_post_id = $post_id ";
        $query .= "AND comment_status = 'approved' ";
        $query .= "ORDER BY comment_id DESC ";

        // send query to DB
        $select_comment = mysqli_query($connection, $query);
 
        // if(!$select_comment){
        //     die('Query Failed'. mysqli_error($connection));
        // }

        // Get result and loop
        while ($row = mysqli_fetch_assoc($select_comment)){
            $comment_date = $row['comment_date'];
            $comment_author = $row['comment_author'];
            $comment_body = $row['comment_content'];
      
?>



<!-- show existing comments -->
<div class="media" style="margin-bottom: 2rem;">
    <a href="#" class="pull-left">
        <img class="media-object" src="#" width="80" height="80" style="background-color: #999999;">
    </a>

    <div class="media-body">
        <h4 class="media-heading">
            <?php echo $comment_author ?>
            <small>
                <?php echo $comment_date ?>
            </small>
        </h4>

        <p>
            <?php echo $comment_body ?>
        </p>
    </div>
</div>

<?php } ?>