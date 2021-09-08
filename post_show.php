<?php  include "includes/db.php"; ?>
 <?php  include "includes/header.php"; ?>

<?php

    // show post
    if (isset($_GET['p_id'])){
        $post_id = $_GET['p_id'];
    }

    // query statement
    $query = "SELECT * FROM posts WHERE id = $post_id ";

    // execute query
    $get_post = mysqli_query($connection, $query);

    while($row = mysqli_fetch_assoc($get_post)){
        $post_title = $row['post_title'];
        $post_author = $row['post_author'];
        $post_date = $row['post_date'];
        $post_image = $row['post_image'];
        $post_content = $row['post_content'];
    }


?>
    <!-- Navigation -->
    
    <?php  include "includes/navigation.php"; ?>
    
 
    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            
            <div class="col-md-8">
             
        
                <h1 class="page-header">Posts</h1>

                <!-- First Blog Post -->
                <h2>
                    <a href="#"><?php echo $post_title ?></a>
                </h2>

                <p class="lead">
                    by <a href="index.php"><?php echo $post_author ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date ?></p>
                <hr>
                <img class="img-responsive" src="images/<?php echo $post_image;?>" alt="">
              
                <p><?php echo $post_content ?></p>


                <hr>

                <!-- comment form-->
                <?php include "includes/show_post_comment.php";?>

                <!-- comment form-->
                <?php include "includes/comments.php";?>
                
                
            </div>
              

            <!-- Blog Sidebar Widgets Column -->
            
            
            <div class="col-md-4">
                <?php include "includes/sidebar.php";?>
            </div>
            
             

        
        <!-- /.row -->

      

   

<?php include "includes/footer.php";?>
