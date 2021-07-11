<?php include('../config/constants.php')?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/admin.css">
    <title>Sthaniya Khana - SignUp</title>
</head>
<body>
    <div class="loginScreen">
        <div class="carousel">
            
        </div>

        <div class="login text-center">
            <div class="logo">
                <img src="../images/logo-image.jpg" alt="Sthaniya Khana-Logo">
            </div>
            <!-- SignUp Form starts here-->
            <?php
                
                if (isset($_SESSION['password-mismatch']))
                {
                    echo $_SESSION['password-mismatch'];
                    unset($_SESSION['password-mismatch']);
                }

            ?>

            <form action="" method = "POST" class= "text-center">
                <input type="text" name="full_name" placeholder="Enter your full name" required><br>
                <input type="text" name="username" placeholder="Enter your Username" required><br>
                <input type="password" name="new_password" placeholder="Enter your password" required><br>
                <input type="password" name="confirm_password" placeholder="Enter your password Again" required><br>
                <button type="signup"  name="signup" class="btn-primary">SignUp As Admin</button>
                <button type="login"  name="login" class="btn-primary">Login As Admin</button><br><br>
                <button type="guest"  name="guest" class="btn-secondary">Visit As Guest</button>
            </form>
            <!-- SignUp Form ends here -->
            <br><br>
            <p class= "text-center"> Created By- <a href="#"> Saurav Rauniyar</a></p>
        </div>
    </div>
    
</body>
</html>

<?php

    if (isset($_POST['signup']))
    {
        // 1. Get the data from signUp form
        $full_name = mysqli_real_escape_string($conn, $_POST['full_name']);
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $new_password = md5($_POST['new_password']);
        $confirm_password = md5($_POST['confirm_password']);
        

        if ($new_password == $confirm_password)
        {
            // 2. SQL to check if the user with username and 
                $sql = "INSERT INTO tbl_admin SET
                    full_name = '$full_name',
                    username = '$username',
                    password = '$new_password'
                ";
            
            // execute the query
            $res = mysqli_query($conn, $sql) or die(mysqli_error());

            // check whether the query is executed or not 
            if ($res == true)
            {
                // query is executed
                $_SESSION['added_admin'] = '<div class="success">Hello, '.$username.' Now you can login</div>';
                header('location:'.SETURL.'admin/login.php');
            }
            else 
            {
                // query is not executed
                $_SESSION['added_admin'] = '<div class="failed">Failed to create account. Please try later</div>';
                header('location:'.SETURL.'admin/login.php');

            }
        }
        else 
        {
            // redirect to signUp page with session message
            $_SESSION['password-mismatch'] = '<div class="error">Password mismatch.</div>';
            header('location:'.SETURL.'admin/signup.php');
        }
        

    }

    // check whether the submit button is clicked or not 

    if (isset($_POST['login']))
    {
        // redirect to login page
        header('location:'.SETURL.'admin/login.php');
    }

    if(isset($_POST['guest']))
    {
        // redirect to customer page
        header('location:'.SETURL.'index.php');
    }
    

?>