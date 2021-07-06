<?php 

    // authorization access control 
    // check whether the user is logged in or not 

    if(!isset($_SESSION['user'])) // if user is not unset
    {
            // user is not logged in
             // redirect to homepage

             $_SESSION['no-login-message'] = '<div class="error">Please login to Admin Panel.</div>';

             header('location:'.SETURL.'admin/login.php');
    }
?>