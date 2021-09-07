
                <!-- Blog Search Well -->
                <div class="well">
                    <h4>Blog Search</h4>
                    <div class="input-group">

                        
                        <form action="search.php" method="POST">
                            <input type="text" class="form-control" name="search">
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="submit" name="submit">
                                    <span class="glyphicon glyphicon-search"></span>
                            </button>
                            </span>
                        </form>
                        
                    </div>
                    <!-- /.input-group -->
                </div>


                
                <!-- Blog Categories Well -->
                <div class="well">
                    <h4>Blog Categories</h4>
                    <div class="row">
                        <div class="col-lg-12">
                            <ul class="list-unstyled">
                                <?php 
                                    // query statement for category records
                                    $query = "SELECT * FROM categories";
                                    $categories = mysqli_query($connection, $query);

                                    // loop to display record
                                    while($row = mysqli_fetch_array($categories)){
                                        $cat_id = $row['cat_id'];
                                        $cat_title = $row['cat_title'];
                                        echo "<li><a href='posts_by_category.php?id={$cat_id}'>{$cat_title}</a></li>";
                                    }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Side Widget Well -->
                <div class="well">
                    <?php include "widget.php" ?>
                </div>