<?php include('partials/navbar.php');?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Food</h1>
        <br>
        
        <?php 

            if (isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }

            if (isset($_SESSION['extension-mismatch']))
            {
                echo $_SESSION['extension-mismatch'];
                unset($_SESSION['extension-mismatch']);
            }
        
        ?>

        <form action="" method="post" enctype='multipart/form-data'>
            <table class='tbl-30'>
                <tr>
                    <td>Title:</td>
                    <td>
                        <input type="text" name='title' placeholder='Enter food title'>
                    </td>
                </tr>
                <tr>
                    <td>Description:</td>
                    <td>
                        <textarea name="description" cols="20" rows="5" placeholder="Enter the description of the food" style='width:15vw; padding:0.2rem 0 0.2rem 0.2rem; border-radius:0.4rem'></textarea>
                    </td>
                </tr>
                <tr>
                    <td>Price:</td>
                    <td>
                        <input type="number" name='price' placeholder="Enter price of the food">
                    </td>
                </tr>
                <tr>
                    <td>Upload Photo:</td>
                    <td>
                        <input type="file" name='img'>
                    </td>
                </tr>
                <tr>
                    <td>Category:</td>
                    <td>
                        <select name="category" style='width:15vw; padding:0.2rem 0 0.2rem 0.2rem; border-radius:0.4rem'>

                            <?php 

                                // create PHP code to display categories from database

                                // 1. Create SQL to get all active categories from database 
                                $sql  = "SELECT * FROM tbl_category WHERE active='Yes'";

                                // Execute the query
                                $res = mysqli_query($conn, $sql);

                                $count = mysqli_num_rows($res);
                                
                                if ($count>0)
                                {
                                    //echo "if true we have category";
                                     while ($row = mysqli_fetch_assoc($res))
                                     {
                                         $id = $row['id'];
                                         $title = $row['title'];
                                         ?>

                                            <option value="<?php echo $id;?>"><?php echo $title;?></option>

                                         <?php
                                     }


                                }
                                else 
                                {
                                    //echo "No category";
                                    ?>
                                        <option value="0">No Category Found.</option>
                                    <?php
                                }

                            ?>

                            
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Featured:</td>
                    <td>
                        <input type="radio" name='featured' value='yes'>Yes
                        <input type="radio" name='featured' value='no'>No
                    </td>
                </tr>
                <tr>
                    <td>Active</td>
                    <td>
                        <input type="radio" name='active' value='yes'>Yes
                        <input type="radio" name='active' value='No'>No
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <button type='submit' name='submit' class='btn-primary'>Add Food</button>
                    </td>
                </tr>
            </table>
        
        </form>

        <?php 
        
            // check whether the button is clicked or not 
            if (isset($_POST['submit']))
            {
                //echo 'button';

                // 1. GET the data from the form
                
                $title = $_POST['title'];
                $description = $_POST['description'];
                $price = $_POST['price'];
                $category = $_POST['category'];

                // check whether radio button is checked or not for featured and active

                if(isset($_POST['featured']))
                {
                    $featured = $_POST['featured'];
                }
                else 
                {
                    $featured ='No';
                }

                if(isset($_POST['active']))
                {
                    $active = $_POST['active'];
                }
                else 
                {
                    $active ='No';
                }

                // 2. upload the image if selected
                
                if (isset($_FILES['img']['name']))
                {
                    // GET the details of the selected image 

                    $image_name = $_FILES['img']['name'];

                    // check whether the image is selected or not and upload image only if selected
                    if($image_name !="")
                    {
                        // image is selected
                        // A. rename the image 
                        // get the extension of the selected image (jpg, jpeg, png, gif) only. 

                        $ext = end(explode(".", $image_name));

                        if ($ext=='png' || $ext=='jpg' || $ext == 'jpeg' || $ext == 'gif')
                        {
                            // create new name for the image
                            $image_name = 'Food_name_'.rand(000,999).'.'.$ext; // new iamge name may be 'Food_name_007.jpg';

                            // B. upload the image
                            // GET the src path and the destination path

                            // src path is the current location of the image
                            $src = $_FILES['img']['tmp_name'];
                            
                            // destination path for the image to be uploaded
                            $dst = '../images/food/'.$image_name;

                            // finally upload the food image
                            $upload = move_uploaded_file($src, $dst);

                            if($upload == false)
                            {
                                // failed to upload the image 
                                // redirect to add food page with error message
                                $_SESSION['upload'] = '<div class="error">Failed to upload Image.</div>';
                                $header('location:'.SETURL.'admin/manage-food.php');
                                // stop the process
                                die();
                            }
                        }
                        else 
                        {
                            $_SESSION['extension-mismatch'] = '<div class="error">Extension of the image should be jpg or jpeg or png or gif only!</div>';

                            header('location:'.SETURL.'admin/manage-food.php');
                        }
                        
                    }
                }
                else 
                {
                    $image_name = ""; // Setting default value as blank
                }


                // 3. insert into the database;
                // crete SQL Query to save or add food
                $sql2 = "INSERT INTO tbl_food SET
                    title='$title',
                    description ='$description',
                    price = $price,
                    image_name = '$image_name',
                    category_id = $category,
                    featured = '$featured',
                    active = '$active'
                ";

                // execute the query
                $res2 = mysqli_query($conn, $sql2);

                // check whether data is inserted or not

                if ($res2 == TRUE)
                {
                    $_SESSION['add'] = '<div class="success">Food added Successfully!!!</div>';
                    header('location:'.SETURL.'admin/manage-food.php');
                }
                else 
                {
                    $_SESSION['add'] = '<div class="error">Failed to add Food!!!</div>';
                    header('location:'.SETURL.'admin/manage-food.php');
                }
                // 4. redirect with message with manage food 
            }
        ?>


    </div>

</div>


<?php include('partials/footer.php');?>

