<?php include('partials/navbar.php');?>

<?php 

    // check whether the id is set or not 
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

        <form action="" method='POST' enctype='multipart/form-data'>
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
                        <textarea name="description"  cols="20" rows="5" ><?php echo $description;?></textarea>
                    </td>
                </tr>
                <tr>
                    <td>Price:</td>
                    <td>
                        <input type="number" name='price' value="<?php echo $price;?>">
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
                        <select name="category">">
                            
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
                                        <option <?php if($current_category == $category_id) {echo "selected";}?> value="<?php echo $category_id;?>"><?php echo $category_title;?></option>
                                        <?php
                                    }
                                }
                                else 
                                {
                                    // category not available 
                                    echo '<option value = "0"> Category Not Available.</option>';
                                }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Featured:</td>
                    <td>
                        <input <?php if($featured=="Yes") { echo "checked";}?> type="radio" name="featured" value='Yes'>Yes
                        <input <?php if($featured=="No") {echo "checked";}?> type="radio" name="featured" value='No'>No
                    </td>
                </tr>
                <tr>
                    <td>Active:</td>
                    <td>
                        <input <?php if($active == "Yes") {echo "checked" ;}?> type="radio" name="active" value='Yes'>Yes
                        <input <?php if($active == "No") {echo "checked" ;}?> type="radio" name="active" value='No'>No
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

        <?php 

                if (isset($_POST['submit']))
                {
                    //echo 'sbumit';
                    // 1. GET all the details from the form
                    $id = $_POST['id'];
                    $title = $_POST['title'];
                    $description = $_POST['description'];
                    $price = $_POST['price'];
                    $curr_img = $_POST['curr_img'];
                    $category = $_POST['category'];

                    $featured = $_POST['featured'];
                    $active = $_POST['active'];

                    // 2. Upload the image if selected

                    // check whether upload button is clicked or not 
                    if (isset($_FILES['new_img']['name']))
                    {
                        // upload button clicked
                        $image_name = $_FILES['new_img']['name']; // new image name 

                        // check whether the file is available or not 
                        if ($image_name !="")
                        {
                            // image is available 
                            // rename the image 
                            $ext = end(explode('.', $image_name)); 

                            if ($ext =='jpg' || $ext == 'jpeg' || $ext== 'png' || $ext =='gif' )
                            {
                                // A. uploading new image 
                                $image_name = 'Food_name_'.rand(000,999).'.'.$ext;

                                // source path
                                $src = $_FILES['new_img']['tmp_name'];

                                //destination path
                                $dest = '../images/food/'.$image_name;

                                $upload = move_uploaded_file($src, $dest);

                                if ($upload == false)
                                {
                                    // redirect to manage food 
                                    $_SESSION['upload'] = '<div class="error">Failed to upload new image</div>';
                                    // redirect to manage food page
                                    header('location:'.SETURL.'admin/mange-food.php');
                                    // stop the process
                                    die();
                                }

                                // 3. Remove the image if new image is uploaded and current image exists
                                // B. remove current image 
                                if ($curr_img !='')
                                {
                                    // current image is available 
                                    // remove the image 
                                    $remove_path = '../images/food/'.$curr_img;

                                    $remove = unlink($remove_path);
                                    
                                    // check whether the image is removed or not 
                                    if ($remove == false)
                                    {
                                        // failed to remove current image 
                                        $_SESSION['remove-curr-img'] = '<div class="error">Failed to remove current image.</div>';
                                        // redirect to manage-food 
                                        header('location:'.SETURL.'admin/manage-food.php');
                                        // stop the process
                                        die();
                                    }
                                }
                            }
                            else 
                            {
                                $_SESSION['ext-mismatch'] = '<div class="error">Files should be of (.png, .jpg, .jpeg, .gif)</div>';
                                header('location:'.SETURL.'admin/manage-food.php');
                            }
                        }
                        else 
                        {
                            $image_name = $curr_img;
                        }
                    }
                    else 
                    {
                        $image_name = $curr_img;
                    }

                    

                    // 4. update the food in the database
                    $sql3 = "UPDATE tbl_food SET
                        title = '$title',
                        description = '$description',
                        price = $price,
                        image_name = '$image_name',
                        category_id = $category,
                        featured = '$featured',
                        active = '$active'
                        WHERE id = $id
                    ";
                    
                    // execute the query
                    $res3 = mysqli_query($conn, $sql3);

                    echo $res3;
                    // check wether the query is executed or not 
                    if ($res3 == true)
                    {
                        // Query is executed and food updated
                        $_SESSION['update'] = '<div class="success">Food updated successfully</div>';
                        // 5. redirect to manage food with session message
                        header('location:'.SETURL.'admin/manage-food.php');
                    }
                    else 
                    {
                        // Query is executed and food updated
                        $_SESSION['update'] = '<div class="error">Failed to update food</div>';
                        // 5. redirect to manage food with session message
                        header('location:'.SETURL.'admin/manage-food.php');
                    }
                    
                }
                                
        ?>


    </div>
</div>

<?php include('partials/footer.php');?>

