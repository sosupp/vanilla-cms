<form action="#" method="post">
    <div class="form-group">
        <!-- showing record in edit form -->
        <?php
            if(isset($_GET['edit'])){
                $cat_id = $_GET['edit'];
                $query = "SELECT * FROM categories WHERE cat_id = $cat_id ";
                $edit_cat = mysqli_query($connection, $query);

                while($row = mysqli_fetch_assoc($edit_cat)){
                    $cat_id = $row['cat_id'];
                    $cat_title = $row['cat_title'];

                    ?>
                <label for="cat-title">EDIT Category</label>
                <input type="text" name="cat_title" class="form-control" 
                        value="<?php if(isset($cat_title)) {echo $cat_title;} ?>">

                <input type="hidden" name="cat_id" class="form-control" 
                        value="<?php if(isset($cat_id)) {echo $cat_id;} ?>">

                <div class="form-group" style="margin-top: 0.6rem;">
                    <button type="submit" name="update_record" class="btn btn-primary btn-sm">UPDATE</button>
                </div>
        <?php }}  ?>
        
    </div> 
</form>

<!-- updating logic -->
<?php update_category() ?>

