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
                            Categories
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.php">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i> Blank Page
                            </li>
                        </ol>
                    </div>
                </div>

                <div class="row">
                    <!-- Adding record -->
                    <div class="col-md-4">

                        <!-- include insert cateogry function -->
                        <?php store_category() ?>

                        <form action="categories.php" method="post">
                            <div class="form-group">
                                <label for="cat-title">Add Category</label>
                                <input type="text" name="cat_title" class="form-control" placeholder="Add category name">
                            </div>

                            <div class="form-group">
                                <button type="submit" name="submit" class="btn btn-primary btn-sm">Add Category</button>
                            </div>
                        </form>


                        <!-- EDITING/ updating record -->
                        <?php 
                            if(isset($_GET['edit'])){
                                include "includes/update_category.php";
                            }
                        ?>
                        
                    </div>


                    <div class="col-md-3"></div>
                    

                    <!-- list of categories -->
                    <div class="col-md-5">

                    <h5>Category List</h5>
                    
                    <table class="table table-bordered table-sm table-hover"> 
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Category Title</th>
                                <th colspan="2">Action  </th>
                            </tr>
                        </thead>

                        <tbody>

                            <?php show_category() ?>

                            <!-- Deleting Record -->
                            <?php delete_category()?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


<?php include "includes/footer.php" ?>