<?php include('partials/navbar.php');?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Category</h1>
        <br>

        <?php

            // to check whether the id is set or not
            if (isset($_GET['id']) AND isset($_GET['image_name']))
            {
                // GET the ID and all the other details
                $id = $_GET['id'];
                
                // create SQL Query to get all the details
                $sql = "SELECT * FROM tbl_category WHERE id =$id";

                // execute the query
                $res = mysqli_query($conn, $sql);

                $count = mysqli_num_rows($res);

                if ($count == 1)
                {
                    //echo "Row fetched";
                    // GET the data 

                    $row = mysqli_fetch_assoc($res);
                    $title = $row['title'];
                    $curr_img = $row['image_name'];
                    $featured = $row['featured'];
                    $active = $row['active'];
                }
                else 
                {
                    // echo 'not';
                    // redirect to manage-category.php

                    $_SESSION['no-category-found'] = '<div class="error">Category Not Found!</div>';

                    header('location:'.SETURL.'admin/manage-category.php');
                }
            }
            else 
            {
                // redirect to manage category
                header('location:'.SETURL.'admin/manage-category.php');
            }
        
        ?>

        <form action="" method='POST' enctype='multipart/form-data'>
            <table class='tbl-30'>
                <tr>
                    <td>Title:</td>
                    <td>
                        <input type="text" name ="title" value="<?php echo $title;?>">
                    </td>
                </tr>
                <tr>
                    <td>Current Image:</td>
                    <td>
                        <?php

                            if ($curr_img !="")
                            {
                                // display the image
                                ?>
                                <img src="<?php echo SETURL;?>images/category/<?php echo $curr_img;?>" width = '150px'>
                                <?php 
                            }
                            else 
                            {
                                // display the message
                                echo '<div class="error">Image not Added.</div>';
                            }

                        ?>
                    </td>
                </tr>
                <tr>
                    <td>New Image:</td>
                    <td>
                        <input type="file" name='new_img'>
                    </td>
                </tr>
                <tr>
                    <td>Featured:</td>
                    <td>
                        <input <?php if($featured=="Yes") {echo "checked";} ?> type="radio" name="featured" value="Yes">Yes
                        <input <?php if($featured=='No') {echo 'checked';} ?> type="radio" name="featured" value="No">No
                    </td>
                </tr>
                <tr>
                    <td>Active:</td>
                    <td>
                        <input <?php if($active=='Yes') {echo 'checked';} ?> type="radio" name="active" value="Yes">Yes
                        <input <?php if($active=='No') {echo 'checked';} ?> type="radio" name="active" value="No">No
                    </td>
                </tr>
                <tr>
                    <td colspan='2'>
                        <input type="hidden" name='id' value="<?php echo $id;?>">
                        <input type="hidden" name='curr_img' value="<?php echo $curr_img;?>">
                        <button type='submit' name='submit' class='btn-secondary'>Update Category</button>
                    </td>
                </tr>
            </table>
        </form>
        
        <?php

            if(isset($_POST['submit']))
            {
                //echo 'button clicked';
                // 1. Get all the values from form 
                $title = $_POST['title'];
                $curr_img = $_POST['curr_img'];
                $featured = $_POST['featured'];
                $active = $_POST['active'];

                // 2. Updating new image if selected
                // check whether the image is selected or not 
                if (isset($_FILES['new_img']['name']))
                {
                    // Get the image details
                    $image_name = $_FILES['new_img']['name'];

                    if ($image_name != "")
                    {
                        // A. image available upload the image 
                        // get the extension
                        $ext = end(explode('.', $image_name));

                        if ($ext == 'jpg' || $ext == 'jpeg' || $ext == 'png' || $ext == 'gif')
                        {   
                            // rename the image name 
                            $image_name = "Food_category".rand(000,999).".".$ext;

                            // set source path name
                            $src = $_FILES['new_img']['tmp_name'];

                            // destination path name 
                            $dest = '../images/category/'.$image_name;

                            // upload the image 
                            $upload = move_uploaded_file($src, $dest);

                            // check whether the image is upload or not 
                            if ($upload == false)
                            {
                                // if not uploaded then send session message 
                                $_SESSION['failed-img-upload'] = '<div class="error">Failed to upload image.</div>';
                                // redirect to manage-food page 
                                header('location:'.SETURL.'admin/manage-category.php');
                                // kill the process 
                                die();
                            }

                            // B. Remove the current image 
                            if ($curr_img != '')
                            {
                                $remove_path = '../images/category/'.$curr_img;
                                $remove = unlink($remove_path);
    
                                // check if the old image is removed or not 
                                // if failed to remove then display message and stop the process 
                                if ($remove == false )
                                {
                                    $_SESSION['failed-remove'] = '<div class="error">Failed the remove current image</div>';
                                    // redirect the page to food manage
                                    header('location:'.SETURL.'admin/manage-category.php');
    
                                }
    
                            }
                        }
                        else 
                        {
                            // Session message send
                            $_SESSION['ext-error'] = '<div class="error">File extension should be (.png, .jpeg, .jpg, .gif)</div>';
                            // redirect manage-food page
                            $header('location:'.SETURL.'admin/manage-category.php');
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

                // 3. Update the database 
                $sql2 = "UPDATE tbl_category SET
                    title = '$title',
                    image_name = '$image_name',
                    featured = '$featured',
                    active = '$active'
                    WHERE id = $id
                ";

                // execute Query 
                $res2 = mysqli_query($conn, $sql2);

                // 4. redirect to manage category page
                // check whether executed or not
                if ($res2 == true)
                {
                    // Category updated 
                    $_SESSION['update'] = '<div class="success">Category Updated Successfully !!!</div>';

                    header('location:'.SETURL.'admin/manage-category.php');
                }
                else 
                {
                    $_SESSION['update'] = '<div class="error">Failed to update category.</div>';

                    header('location:'.SETURL.'admin/manage-category.php');
                }
            }
             


        ?>

    </div>
</div>


<?php include('partials/footer.php')?>