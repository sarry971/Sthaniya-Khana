<?php include('partials/navbar.php');?>

    <div class="main-content">
        <div class="wrapper">
            <h1>Add Category</h1>
            <br><br>

            <?php

                if(isset($_SESSION['add']))
                {
                    echo $_SESSION['add'];
                    unset($_SESSION['add']);
                }

                if(isset($_SESSION['upload']))
                {
                    echo $_SESSION['upload'];
                    unset($_SESSION['upload']);
                }

            ?> <br>

            <!--Form starts here-->
            <form action="" method='POST' enctype='multipart/form-data'> <!-- enctype='multipart/form-data adds file into form--> 
                <table class="tbl-30">
                    <tr>
                        <td>Title:</td>
                        <td>
                            <input type="text" name='title' placeholder="Category Title">
                        </td>
                    </tr>
                    <tr>
                        <td>Select Image:</td>
                        <td>
                            <input type="file" name='img'>
                        </td>
                    </tr>
                    <tr >
                        <td>Featured:</td>
                        <td>
                            <input type="radio" name="featured" value="Yes">Yes
                            <input type="radio" name="featured" value="No">No
                        </td>
                    </tr>
                    <tr>
                        <td>Active:</td>
                        <td>
                            <input type="radio" name="active" value="Yes">Yes
                            <input type="radio" name="active" value="No">No
                        </td>
                    </tr>
                    <tr>
                        <td colspan='2'>
                            <button type='submit' name='submit' class='btn-secondary'>Add Category</button>
                        </td>
                    </tr>
                </table>
            </form>
            <!--Form ends here-->

        <?php

            // check wether the button is clicked or not

            if (isset($_POST['submit']))
            {
                //echo 'button clicked';

                // 1. GET the value from the form

                $title= $_POST['title'];
                
                // for radio input type, we need to check whether the button is selected or not

                if (isset($_POST['featured']))
                {
                    // if button is selected then we need to selected the value
                    // echo 'feature click';
                    $featured = $_POST['featured'];
               }
               else 
               {
                   // set the default value to No
                  // echo 'feature  not click';
                   $featured = 'No';
               }

               if (isset($_POST['active']))
               {
                    //echo 'active click';
                    $active = $_POST['active'];
               }
               else 
               {
                    //echo 'feature not click';
                   $active = 'No';
               }

               // Check whether the image is selected or not and set the value for image name accordingly.
                
               // print_r ($_FILES['img']); // $_FILES is array and print_r displays array

               // die(); // break the code here

               if (isset($_FILES['img']['name']))
               {
                   // upload the image 
                   // to upload the image we need image name, source path and destination path
                   $image_name = $_FILES['img']['name'];
                    // upload the image only if image is selected

                    if ($image_name !="")
                    {
                        // auto-renaming the image
                        // GET the extension of our image (.jpg, .png, .gif, etc) e.g "special-momo.jpg"

                        $ext = end(explode(".", $image_name));

                        if ($ext == 'jpg' || $ext == 'jpeg' || $ext == 'png' || $ext == 'gif')
                        {
                            // rename the image 
                            $image_name = 'Food_category_'.rand(000, 999).'.'.$ext; // eg. Food_category_333.jpg;

                            $source_path = $_FILES['img']['tmp_name'];

                            $destination_path = "../images/category/".$image_name;

                            // finally upload the image
                            $upload = move_uploaded_file($source_path, $destination_path);
                        }
                        

                        // check whether the image is uploaded or not
                        // if the image is not uploaded the we will stop the process and redirect with error message

                        if ($upload == false)
                        {
                            // SET message
                            $_SESSION['upload'] = '<div class="error">Failed to upload image.</div>';

                            // redirect to add category page.
                            header('location:'.SETURL.'admin/manage-category.php');
                            die();
                        }
                    }
                   
               }

               else 
               {
                   // dont upload the image and set the img_name as blank;
                   $image_name = '';
               }


               // 2. Create SQL query to insert category into database

               $sql = "INSERT INTO tbl_category SET
                    title ='$title',
                    image_name = '$image_name',
                    featured = '$featured',
                    active = '$active'
               ";

               //3. Execute the query and save in database;
               $res = mysqli_query($conn, $sql);

               // 4. Check whether the query executed or not

               if ($res == TRUE)
               {
                   // Query executed and category added
                    $_SESSION['add'] = '<div class="success">Category Added SuccessFully!!</div>';

                    header('location:'.SETURL.'admin/manage-category.php');
               }
               else 
               {
                   // query failed to execute
                   
                    $_SESSION['add'] = '<div class="error">Failed to add Category</div>';

                    header('location:'.SETURL.'admin/manage-category.php');
               }

            }
        ?>


        </div>
    </div>

<?php include('partials/footer.php');?>