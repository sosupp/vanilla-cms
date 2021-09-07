<?php 
if(isset($_GET['post_id'])){
    $post_id = $_GET['post_id'];

    
    $query = "SELECT * FROM posts WHERE id=$post_id";
    $posts_by_id = mysqli_query($connection, $query);

    while($row = mysqli_fetch_assoc($posts_by_id)){
        $id = $row['id'];
        $author = $row['post_author'];
        $title = $row['post_title'];
        $content = $row['post_content'];
        $category = $row['post_cat_id'];
        $status = $row['post_status'];
        $image = $row['post_image'];
        $tags = $row['post_tags'];
        $comment_count = $row['post_comment_count'];
        $date = $row['post_date'];
    }

}


if(isset($_POST['update_post'])){
    update_post();
}


?>
<div class="row">
    <div class="col-md-6">
        <h1><strong>EDIT POST</strong></h1>
        <form action="" method="post" enctype="multipart/form-data">

            <div class="form-group">
                
                <label for="post_title">Post Title</label>
                <input type="text" value="<?php echo $title; ?>" name="post_title" class="form-control" placeholder="Enter post title">
            </div>

            <div class="form-group">
                <label for="cat_id">Category ID</label>
                <br>
                <select name="post_cat_id" id="" style="width: 100%">
                    
                    <?php 
                        global $connection;
                        $post_cat_query = "SELECT * FROM categories WHERE cat_id = $category";
                        $all_cat_query = "SELECT * FROM categories";
                        $post_categories = mysqli_query($connection, $post_cat_query);
                        $all_categories = mysqli_query($connection, $all_cat_query);
                
                        while($row = mysqli_fetch_assoc($post_categories)){
                            $id = $row['cat_id'];
                            $title = $row['cat_title'];
                            
                            echo "<option value='$id'>$title</option>";
                            
                            
                        }
                        
                        while($row = mysqli_fetch_assoc($all_categories)){
                            $id = $row['cat_id'];
                            $title = $row['cat_title'];
                            
                            echo "<option value='$id'>$title</option>";
                            
                            
                        }     
                    
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label for="post_tags">Post Tag</label>
                <input type="text" value="<?php echo $tags; ?>" name="post_tags" class="form-control" placeholder="Enter post tag">
            </div>

            <div class="form-group">
                <label for="post_author">Author</label>
                <input type="text" value="<?php echo $author; ?>" name="post_author" class="form-control" placeholder="Enter post author">
            </div>

            <div class="form-group">
                <label for="post_status">Post Status</label>
                <input type="text" value="<?php echo $status; ?>" name="post_status" class="form-control" placeholder="Enter Post Status">
            </div>

            <div class="form-group">
                <label for="post_image">Post Image</label>
                
                <input type="file" name="post_image" class="form-control">
                <img src="../images/<?php echo $image ?>" alt="" width="100">
            </div>

            <div class="form-group">
                <label for="post_content">Compose Content</label>
                <br>
                <textarea name="post_content" id="post_content" cols="30" rows="10"
                    placeholder="Enter Post content here" style="width: 100%;"><?php echo $content; ?></textarea>
            </div>


            <button type="submit" name="update_post" class="btn btn-success">UPDATE POST</button>
        </form> 
    </div>
</div>