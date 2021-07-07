<?php 

    include ('../config/constants.php');
    // echo "delete category";

    // check whether the id and image_name value is set or not 

    if (isset($_GET['id']) AND isset($_GET['image_name']))
    {
        // echo "Get the value and delete value";

        // 1. Get the value 

        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        //remove the physical file if available
        if ($image_name != "")
        {
            // image is available then remove it 
            $path = "../images/category/".$image_name;
            // remove the image 
            $remove = unlink($path); // unlink is built in function return boolean value
            
            // if failed to remove the add an error message and stop the process 
            if ($remove == false)
            {
                // set the session message 
                $_SESSION['remove'] = '<div class="error">Failed to remove Category Image</div>';
                // redirect to manage category page
                header('location:'.SETURL.'admin/manage-category.php');
                // die the session
                die();
            }
        }

        // delete data from database 
        // sql query to delete from database

        $sql = "DELETE FROM tbl_category WHERE id = $id";

        // execute the query
        $res = mysqli_query($conn, $sql);

        // check whether the data is delete from database or not 
        if ($res == true)
        {
            // set success message and redirect  
            $_SESSION['delete'] = '<div class="success">Category deleted successfully.</div>';

            //redirect to manage category page with message
            header('location:'.SETURL.'admin/manage-category.php');
        }
        else 
        {
            // set success message and redirect  
            $_SESSION['delete'] = '<div class="error">Failed to delete Category.</div>';

            //redirect to manage category page with message
            header('location:'.SETURL.'admin/manage-category.php');
        }
        
    }
    else 
    {
        // redirect to manage category page
        header('location:'.SETURL.'admin/manage-category.php');
    }
?>