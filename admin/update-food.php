<?php include('partials/navbar.php');?>

<?php 

    if(isset($_GET['id']))
    {
        // GET all the details 
        $id = $_GET['id'];

        // SQL Query to get all details 
        $sql2 = "SELECT * FROM tbl_food WHERE id=$id";
        // execute the query
        $res2 = mysqli_query($conn, $sql2);

        // get the value based on query executed
        $row2 = mysqli_fetch_assoc($res2);
        
        // get individual value 
        $title = $row2['title'];
        $description = $row2['description'];
        $price = $row2['price'];
        $curr_img = $row2['image_name'];
        $current_category = $row2['category_id'];
        $featured = $row2['featured'];
        $active = $row2['active'];

    }
    else 
    {
        // redirect to mange food
        header('location:'.SETURL.'admin/manage-food.php');
    }

?>
<div class="main-content">
    <div class="wrapper">
        <h1>Update Food</h1>
        <br>

        <?php

        ?>
        <form action="" method='post' enctype='multipart/form-data'>
            <table class='tbl-30'>
                <tr>
                    <td>Title:</td>
                    <td>
                        <input type="text" name ='title' value="<?php echo $title;?>">
                    </td>
                </tr>
                <tr>
                    <td>Description:</td>
                    <td>
                        <textarea name="description"  cols="20" rows="5" value="$description" ><?php echo $description;?></textarea>
                    </td>
                </tr>
                <tr>
                    <td>Price:</td>
                    <td>
                        <input type="number" name='price'  value="<?php echo $price;?>">
                    </td>
                </tr>
                <tr>
                    <td>Current Image:</td>
                    <td>
                        <?php 
                            if ($curr_img =="")
                            {
                                // image not available 
                                echo '<div class="error">Image not available.</div>';
                            }
                            else
                            {
                                // image available 
                                ?>
                                <img src = '<?php echo SETURL;?>images/food/<?php echo $curr_img;?>' width='150px'>
                                <?php
                            }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>Select New Image:</td>
                    <td>
                        <input type="file" name='new_img'>
                    </td>
                </tr>
                <tr>
                    <td>Category:</td>
                    <td>
                        <select name="category" value="<?php echo $category_id;?>">
                            
                            <?php
                                // query to get active categories
                                $sql = "SELECT * FROM tbl_food WHERE active='Yes'";

                                // execute the query
                                $res = mysqli_query($conn, $sql);

                                // count rows
                                $count = mysqli_num_rows($res);

                                // check whether category available or not 
                                if ($count > 0)
                                {
                                    // category available
                                    while ($row = mysqli_fetch_assoc($res))
                                    {
                                        $category_title = $row['title'];
                                        $category_id = $row['id'];

                                        // echo "<option value = '$category_id'>$category_title</option>";
                                        ?>
                                        <option <?php if($current_category == $category_id) {echo "selected";}?> value="<?php echo $category_id;?>"><?php echo $category_title?></option>
                                        <?php
                                    }
                                }
                                else 
                                {
                                    echo '<option value = "0"> Category Not available.</option>';
                                }
                            ?>
                            
                            <option value="0">Test</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Featured:</td>
                    <td>
                        <input <?php if($featured=="yes") { echo "checked";}?> type="radio" name="featured" value='yes'>Yes
                        <input <?php if($featured=="no") {echo "checked";}?> type="radio" name="featured" value='no'>No
                    </td>
                </tr>
                <tr>
                    <td>Active:</td>
                    <td>
                        <input <?php if($active == 'yes') {echo 'checked';}?> type="radio" name="active" value='yes'>Yes
                        <input <?php if($active == 'no') {echo 'checked';}?> type="radio" name="active" value='no'>No
                    </td>
                </tr>
                <tr>
                    <td colspan='2'>
                        <input type="hidden" name='id' value='<?php echo $id;?>'>
                        <input type="hidden" name='curr_img' value='<?php echo $curr_img;?>'>
                        <button type='submit' name='submit' class='btn-secondary'>Update Category</button>
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php include('partials/footer.php');?>