<?php
    /****************** 
        Checking form error
    ********************/
     function confirm_query($result){
         global $connection;
        
         if(isset($_GET['delete'])){
            if(!$result){
                die("QUERY FAILED" . mysqli_error($connection));
            } else {
                echo "Deleted Successfully";
            }
         } else {
            if(!$result){
                die("QUERY FAILED" . mysqli_error($connection));
            } else {
                echo "Record Added Successfully";
            }
        }
        
     }
    
    /****************** 
        Storing record
    ********************/
    function store_category(){
        global $connection;
        if(isset($_POST['submit'])){
            // get name attributes
            $cat_title = $_POST['cat_title'];

            if($cat_title == "" || empty("cat_title")){
                echo "<h2 style='color: red;'> This field cannot be empty </h1>";
            } else{
                // query to insert record
                $query = "INSERT INTO categories(cat_title) ";
                $query .= "VALUE('{$cat_title}')";

                // send query to DB
                $add_cat = mysqli_query($connection, $query);

                // check if action was successful or not
                if(!$add_cat){
                    echo "ACTION FAILED" . mysqli_error($connection);
                } else{
                    echo "<h2 style='color: green;'> Added successfully. </h1>";
                }
            }

            
        }
    }

    /****************** 
        Show records
    ********************/
    function show_category(){
        global $connection;
        $query = "SELECT * FROM categories";
        $categories = mysqli_query($connection, $query);

        while($row = mysqli_fetch_assoc($categories)){
            $id = $row['cat_id'];
            $title = $row['cat_title'];

            echo "<tr>";
            echo "<td>{$id}</td>";
            echo "<td>{$title}</td>";
            echo "<td><a href='categories.php?delete={$id}'>Delete </a></td>";
            echo "<td><a href='categories.php?edit={$id}'>Edit </a></td>";
            echo "<tr>";
        }                 
    }


    /******************* 
        Delete records
    ********************/
    function delete_category(){
        global $connection;
        if(isset($_GET['delete'])){
            // get the id of record to delete
            $id = $_GET['delete'];

            // query statement to delete
            $query = "DELETE FROM categories WHERE cat_id = {$id} ";

            // pass query to DB with connection
            $delete_record = mysqli_query($connection, $query);

            // refresh page or redirect upon delete
            header("Location: categories.php");

            // check if action was successful
            if(!$delete_record){
                echo "Failed to delete " . mysqli_error($connection);
            } else{
                echo "<h2 style='color: green;'> Record deleted successfully. </h2>";
            }
        }
    }

    /******************* 
        Update records
    ********************/
    function update_category(){
        global $connection;
        
        if(isset($_POST['update_record'])){
            $title = $_POST['cat_title'];
            $cat_id = $_POST['cat_id'];
            $query = "UPDATE categories SET cat_title = '{$title}' WHERE cat_id = {$cat_id} ";
    
            $update = mysqli_query($connection, $query);
            // refresh page or redirect upon delete
            header("Location: categories.php");
    
            if(!$update){
                die("Failed to update" . mysqli_error($connection));
            } else{
                echo "<h2 style='color: green;'> Record updated successfully. </h2>";
            }
    
                
        }
    }


    /******************* 
        POST LIST: index
    ********************/
    function post_list(){
        global $connection;
        $query = "SELECT * FROM posts";
        $posts = mysqli_query($connection, $query);

        while($row = mysqli_fetch_assoc($posts)){
            $id = $row['id'];
            $author = $row['post_author'];
            $title = $row['post_title'];
            $category = $row['post_cat_id'];
            $status = $row['post_status'];
            $image = $row['post_image'];
            $tags = $row['post_tags'];
            $comment_count = $row['post_comment_count'];
            $date = $row['post_date'];

            echo "<tr>";
            echo "<td>{$id}</td>";
            echo "<td>{$author}</td>";
            echo "<td>{$title}</td>";

            // display category name related to post dynamically
            $query = "SELECT * FROM categories WHERE cat_id = {$category}";
            $get_categories = mysqli_query($connection, $query);

            while($row = mysqli_fetch_assoc($get_categories)){
                $cat_title = $row['cat_title'];
                echo "<td>{$cat_title}</td>";
            }
            
            echo "<td>{$status}</td>";
            echo "<td><img src='/images/{$image}' width='100' /></td>";
            echo "<td>{$tags}</td>";
            echo "<td>{$comment_count}</td>";
            echo "<td>{$date}</td>";
            echo "<td><a href='posts.php?delete={$id}'>Delete </a></td>";
            echo "<td><a href='posts.php?source=edit_post&post_id={$id}'>Edit </a></td>";
            echo "<tr>";
        }
        

    }

    /******************* 
        Edit Post
    ********************/
    function edit_post(){
        global $connection;
        // checking is post id is set
        if(isset($_GET['post_id'])){
            $post_id = $_GET['post_id'];

            
            $query = "SELECT * FROM posts WHERE id=$post_id";
            $posts_by_id = mysqli_query($connection, $query);

            while($row = mysqli_fetch_assoc($posts_by_id)){
                $id = $row['id'];
                $author = $row['post_author'];
                $title = $row['post_title'];
                $category = $row['post_cat_id'];
                $status = $row['post_status'];
                $image = $row['post_image'];
                $tags = $row['post_tags'];
                $comment_count = $row['post_comment_count'];
                $date = $row['post_date'];
            }
        }
    }

    /******************* 
        Update Post
    ********************/
    function update_post(){
        global $connection;
        // checking for update submit button
            $post_id = $_GET['post_id'];
            $post_title = $_POST['post_title'];
            $post_cat_id = $_POST['post_cat_id'];
            $post_tags = $_POST['post_tags'];
            $post_author = $_POST['post_author'];
            $post_status = $_POST['post_status'];
            $post_content = $_POST['post_content'];
            
            $post_image = $_FILES['post_image']['name'];
            $post_image_temp = $_FILES['post_image']['tmp_name'];

            // moving image into directory
            move_uploaded_file($post_image_temp, "../images/ $post_image");

            // fetch image if image field is empty
            if(empty($post_image)){
                $query = "SELECT * FROM posts WHERE id = $post_id ";
                $select_image = mysqli_query($connection, $query);

                while($row = mysqli_fetch_array($select_image)){
                    $post_image = $row['post_image'];
                }
            }

            // query to update post
            $query = "UPDATE posts SET ";
            $query .= "post_title = '{$post_title}', ";
            $query .= "post_cat_id = {$post_cat_id}, ";
            $query .= "post_tags = '{$post_tags}', ";
            $query .= "post_author = '{$post_author}', ";
            $query .= "post_status = '{$post_status}', ";
            $query .= "post_content = '{$post_content}', ";
            $query .= "post_date = now(), ";
            $query .= "post_image = '{$post_image}' ";
            $query .= "WHERE id=$post_id ";

            // execute query with DB connection
            $update_post = mysqli_query($connection, $query);

            confirm_query($update_post);

    }


    /******************* 
        Delete Post 
    ********************/

    function delete_post(){
        global $connection;
        if(isset($_GET['delete'])){
            // get post to delete with id
            $post_id = $_GET['delete'];

            // query to send to DB
            $query = "DELETE FROM posts WHERE id = {$post_id} ";

            // delete: send query to DB
            $delete = mysqli_query($connection, $query);

            // checking success or failure
            confirm_query($delete);
        }
    }



    // Comment List
    function comment_list(){
        global $connection;
        $query = "SELECT * FROM comments";
        $comments = mysqli_query($connection, $query);

        while($row = mysqli_fetch_assoc($comments)){
            $id = $row['comment_id'];
            $author = $row['comment_author'];
            $content = $row['comment_content'];
            $status = $row['comment_status'];
            $email = $row['comment_email'];
            $date = $row['comment_date'];
            $post_id = $row['comment_post_id'];

            echo "<tr>";
            echo "<td>{$id}</td>";
            echo "<td>{$author}</td>";
            echo "<td>{$content}</td>";
            echo "<td>{$email}</td>";
            echo "<td>{$status}</td>";

            // display post title related to the comment
            $query = "SELECT * FROM posts WHERE id = {$post_id}";
            $get_post = mysqli_query($connection, $query);
            while($row = mysqli_fetch_assoc($get_post)){
                $post_title = $row['post_title'];
                echo "<td>{$post_title}</td>";
            }

            echo "<td><a href='comments.php?delete={$id}'>Approve </a></td>";
            echo "<td><a href='comments.php?delete={$id}'>Unapprove </a></td>";
            echo "<td><a href='comments.php?delete={$id}'>Delete </a></td>";
            echo "<td>{$date}</td>";
            echo "<tr>";
        }
        

    }

?>