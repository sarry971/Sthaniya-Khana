<?php include('../config/constants.php')?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/admin.css">
    <title>Sthaniya Khana - Login</title>
</head>
<body>
    <div class="loginScreen">
        <div class="carousel">
            <img src="../images/burger.jpg" alt="">
        </div>

        

        <div class="login text-center">
            <div class="logo">
                <img src="../images/logo-image.jpg" alt="Sthaniya Khana-Logo">
            </div>
            <!-- Login Form starts here-->
            <?php
                
                if (isset($_SESSION['login']))
                {
                    echo $_SESSION['login'];
                    unset($_SESSION['login']);
                }

                if (isset($_SESSION['no-login-message']))
                {
                    echo $_SESSION['no-login-message'];
                    unset($_SESSION['no-login-message']);
                }

            ?>

            <form action="" method = "POST" class= "text-center">
                <input type="text" name="username" placeholder="Enter your Username">
                <input type="password" name="password" placeholder="Enter your password"><br>
                <button type="submit"  name="submit" class="btn-primary">Login As Admin</button>
                <button type="guest"  name="guest" class="btn-secondary">Visit As Guest</button>
            </form>
            <!-- Login Form ends here -->
            <br><br>
            <p class= "text-center"> Created By- <a href="#"> Saurav Rauniyar</a></p>
        </div>
    </div>
    
</body>
</html>

<?php
    // check whether the submit button is clicked or not 

    if (isset($_POST['submit']))
    {
        // process for login
        // 1. GET the data from login form 

        $username = $_POST['username'];
        $password = md5($_POST['password']);
     
        // 2. SQL to check whether the user with username and password exists or not 
        $sql = "SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";

        // 3. Execute the query
        $res = mysqli_query($conn, $sql);

        // 4. Count rows to check whether the user exists or not
        $count = mysqli_num_rows($res);

        //echo "$count";
        if ($count == 1)
        {
            //echo "user exists";
            // user available and success
            $_SESSION['login'] = '<div class="success">Hello, '.$username.'</div>';
            $_SESSION['user'] = $username; // to check whether the user is logged in or not and logout will unset it

            header('location:'.SETURL.'admin/index.php');
        }
        else
        {
            //echo "user doesnot exists";
            
            // user available and success
            $_SESSION['login'] = '<div class="error">Username or Login did not match.</div>';

            header('location:'.SETURL.'admin/login.php');
        }
    }

    if(isset($_POST['guest']))
    {
        header('location:'.SETURL.'index.php');
    }
    

?>