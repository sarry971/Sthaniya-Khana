<?php 

    include('../config/constants.php');

    //echo "delete";
    
    if (isset($_GET['id']) AND isset($_GET['image_name']))
    {
        // process to delete
        //echo "Process to delete";

        // 1. GET ID and image name
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        // 2. remove the image if available
        // check whether the image is available or not and delete only if available 

        if ($image_name !="")
        {
            // it has image and need to delete it from folder

            // get the physical path
            $path = '../images/food/'.$image_name;

            //remove image file from folder
            $remove = unlink($path);
            
            // check whether the image is removed or not 
            if ($remove == false)
            {
                // failed to remove image 
                $_SESSION['upload-fail'] = '<div class="error">Failed to remove image.</div>';

                // redirect to manage food
                header('location:'.SETURL.'admin/manage-food.php');

                // stop the process of deleting food
                die();
            }
        }

        // 3. Delete food from database
        $sql = "DELETE FROM tbl_food WHERE id =$id";

        // execute the query
        $res = mysqli_query($conn, $sql);

        // check whether the query executed or not and set he session message respectively
        if ($res == true)
        {
            $_SESSION['delete'] = '<div class="success">Food Deleted Successfully!!!</div>';
            header('location:'.SETURL.'admin/manage-food.php');
        }
        else 
        {
            // set success message and redirect  
            $_SESSION['delete'] = '<div class="error">Failed to delete Food.</div>';

            //redirect to manage category page with message
            header('location:'.SETURL.'admin/manage-food.php');
        }

        // 4. Redirect to manage food with session message
    }
    else 
    {
        // redirect to manage food page
        $_SESSION['unauth'] = '<div class="error">Unauthorized Access.</div>';
        header('location:'.SETURL.'admin/manage-food.php');
    }
?>