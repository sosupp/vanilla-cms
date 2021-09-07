<?php include "includes/header.php" ?>
<?php include "function.php" ?>
    <div id="wrapper">
        <!-- Navigation -->
        <?php include "includes/navs.php" ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Posts
                        </h1>

                        <div class="" style="margin-bottom: 10px;">
                            <form action="" method="get">
                                <button type="submit" name="source" value="add_post"
                                    class="btn btn-primary btn-sm">ADD POST</button>
                            </form>
                            
                        </div>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.php">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i> Posts
                            </li>
                        </ol>

                        <!-- switch statement to include some CRUD of post on the same page -->
                        <?php 
                            // check for the submitted key 
                            if(isset($_GET['source'])){
                                // create a variable to store the key if available
                                $source = $_GET['source'];
                            } else{
                                // to prevent error if $source variable is not defined
                                $source = "";
                            }
                            
                            switch($source){
                                case 'add_post';
                                include "includes/add_post.php";
                                break;

                                case 'edit_post';
                                include "includes/edit_post.php";
                                break;  

                                default:
                                    include "includes/all_post.php";
                                break;

                            }
                        
                        ?>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>

   

<?php include "includes/footer.php" ?>