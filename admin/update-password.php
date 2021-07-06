<?php include('partials/navbar.php')?>

    <div class="main-content">
        <div class="wrapper">
          <h1>Change Password</h1>  
          <br><br>

          <?php 
            if(isset($_GET['id']))
            {
                $id = $_GET['id'];
            }

          ?>
          <form action="" method='POST'>
              <table class='tbl-30'>
                  <tr>
                      <td>Current Password:</td>
                      <td>
                          <input type="password" name="current_password"  placeholder="Enter your current password">
                      </td>
                  </tr>
                  <tr>
                      <td>New Password:</td>
                      <td>
                        <input type="password" name="new_password" placeholder="Enter your new password">
                      </td>
                  </tr>
                  <tr>
                      <td>Confirm Password:</td>
                      <td>
                          <input type="password" name="confirm_password" placeholder="Enter your new password again">
                        </td>
                  </tr>
                  <tr>
                      <td colspan='2'>
                        <input type="text" name="id" value="<?php echo $id; ?>">
                        <button type="submit" name='submit' class='btn-primary'>Change Password</button>
                      </td>
                  </tr>
              </table>
          </form>
        
        </div>

    </div>

<?php

    //check whether the submit button is clicked or not 
    if (isset($_POST['submit']))
    {
        //echo "Hello";
        // 1. GET the data from form
        $id = $_POST['id'];
        $current_password = md5($_POST['current_password']);
        $new_password = md5($_POST['new_password']);
        $confirm_password = md5($_POST['confirm_password']);

        // 2. check whether the user with current ID and current password exists or not 
        $sql = "SELECT * FROM tbl_admin WHERE id = $id && password = '$current_password'";

        // execute the Query

        $res = mysqli_query($conn, $sql);

        if ($res == TRUE)
        {
            $count = mysqli_num_rows($res);
            if($count ==1)
            {
                // user exists and password is changed
                // echo "hello";

                // check whether the new password and confirm password match or not 

                if ($new_password == $confirm_password)
                {
                    // update password
                    $sql2 = "UPDATE tbl_admin SET
                        password ='$new_password'
                        WHERE id = $id
                    ";

                    // check whether the query executed or not
                        $res2 = mysqli_query($conn, $sql2);
                    if ($res2 == true)
                    {
                        // display the success message
                        $_SESSION['password-changed'] = '<div class="success">Password Changed Sucessfully!</div>';

                        header('location:'.SETURL.'admin/manage-admin.php');
                    }
                    else 
                    {
                        // display error message
                        $_SESSION['password-not-match'] = '<div class="error">ERROR 404: Password Not Match!</div>';

                        header('location:'.SETURL.'admin/manage-admin.php');
                    }
                }
                else 
                {
                        $_SESSION['password-not-match'] = '<div class="error">ERROR 404: Password Not Match!</div>';

                        header('location:'.SETURL.'admin/manage-admin.php');
                }
            }
            else 
            {
                // user doesn't exist, set message and redirect to manage-admin page
                $_SESSION['user-not-found'] = '<div class="error">ERROR 404: User Not Found!</div>';
                // redirect the user to manage-admin page 
                header('location:'.SETURL.'admin/manage-admin.php');
            }

            


        }
        // 3. Check whether the new password adn confirm password match or not.
        // 4. Change  password if all above is true
    }
    
?>

<?php include('partials/footer.php')?>