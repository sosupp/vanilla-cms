<?php 
    if(isset($_POST['submit'])){

        $post_title = $_POST['post_title'];
        $post_cat_id = $_POST['post_cat_id'];
        $post_tags = $_POST['post_tags'];
        $post_author = $_POST['post_author'];
        $post_status = $_POST['post_status'];
        $post_content = $_POST['post_content'];

        $post_image = $_FILES['post_image']['name'];
        $post_image_temp = $_FILES['post_image']['tmp_name'];
        $post_date = date('d-m-y');
        $post_comment_count = 4;

        // moving image into directory
        move_uploaded_file($post_image_temp, "../images/$post_image");
        
        // query statement
        $query = "INSERT INTO posts(post_cat_id, post_title, post_author, post_date, post_image, post_content, post_tags,
                    post_comment_count, post_status) ";
        $query .= "VALUES({$post_cat_id}, '{$post_title}', '{$post_author}', now(), '{$post_image}', '{$post_content}',
                '{$post_tags}', {$post_comment_count}, '{$post_status}' )";
        
        // persisting data to DB
        $create_post = mysqli_query($connection, $query);

        // checking for error: using a function
        confirm_query($create_post);

    }


?>

<div class="row">
    <div class="col-md-6">
        <form action="" method="post" enctype="multipart/form-data">

            <div class="form-group">
                <label for="post_title">Post Title</label>
                <input type="text" name="post_title" class="form-control" placeholder="Enter post title">
            </div>

            <div class="form-group">
            <select name="post_cat_id" id="" style="width: 100%">
                    <option value="">Select Post Category</option>
                    
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
                <input type="text" name="post_tags" class="form-control" placeholder="Enter post tag">
            </div>

            <div class="form-group">
                <label for="post_author">Author</label>
                <input type="text" name="post_author" class="form-control" placeholder="Enter post author">
            </div>

            <div class="form-group">
                <label for="post_status">Post Status</label>
                <input type="text" name="post_status" class="form-control" placeholder="Enter Post Status">
            </div>

            <div class="form-group">
                <label for="post_image">Post Image</label>
                <input type="file" name="post_image" class="form-control">
            </div>

            <div class="form-group">
                <label for="post_content">Compose Content</label>
                <br>
                <textarea name="post_content" id="post_content" cols="30" rows="10"
                    placeholder="Enter Post content here" style="width: 100%;"></textarea>
            </div>


            <button type="submit" name="submit" class="btn btn-success">ADD POST</button>
        </form> 
    </div>
</div>
