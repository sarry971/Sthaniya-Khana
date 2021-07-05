<?php 

    // include constants.php file here
    include('../config/constants.php');

    // 1. get tthe id of the admin to be deleted
        $id=$_GET['id'];
    
    // 2. create SQL Query to delete admin
        $sql = "DELETE FROM tbl_admin WHERE id = $id";

        // execute the query;
        $res = mysqli_query($conn, $sql);

        // check whether the query executed successfully or not

        if ($res == TRUE)
        {
            // query executed successfully adn admin deleted.
           // echo "Admin Deleted";
           // create session variable to display message
           $_SESSION['delete'] = "<div class='success'>Admin deleted successfully</div>";

           // redirect to manage admin page
           header('location:'.SETURL.'admin/manage-admin.php');
        }

        else 
        {   
            // failed to delete admin
            // echo "Admin not deleted";
            $_SESSION['delete'] ='<div class="error">Failed to delete Admin. Try Again Later.</div>';
            header('location:'.SETURL.'admin/manage-admin.php');
        }

    // 3. redirect to manage admin page with message (success/ error)

    

    



?>

