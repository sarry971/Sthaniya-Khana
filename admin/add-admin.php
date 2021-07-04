<?php include('partials/navbar.php');?>

    <div class="main-content">
        <div class="wrapper">
            <h1>Add Admin</h1>
            <br><br>
            <?php
                if(isset($_SESSION['add']))
                {
                    echo $_SESSION['add'];
                    unset($_SESSION['add']);
                }
            ?>
            <form action="" method='POST'>
                <table class='tbl-30'>
                    <tr>
                        <td>Full Name:</td>
                        <td><input type="text" name="fullname" placeholder="Enter your Name"></td>
                    </tr>
                    <tr>
                        <td>Username:</td>
                        <td><input type="text" name="username" placeholder="Enter your Username"></td>
                        
                    </tr>
                    <tr>
                    <td>Password:</td>
                        <td><input type="password" name="password" placeholder="Enter unique password(atleast 6 character)"></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <button type="submit" class="btn-secondary" name='submit'>Add Admin</button>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>

<?php include('partials/footer.php')?>

<?php
    // process the value from form and save it in database
    // check whether the submit button is clicked or not

    if (isset($_POST['submit']))
    {
        // button clicked 
        //echo 'Button Clicked';

        //1. Get the data from form

        $full_name = $_POST['fullname'];
        $username = $_POST['username'];
        $password = md5($_POST['password']);  // password encryption with MD5.

        //2. SQL Query to save the data into database

        $sql = "INSERT INTO tbl_admin SET
            full_name = '$full_name',
            username = '$username',
            password = '$password'
        ";

           
        // 3. Execute Query and Save data into database.
        $res = mysqli_query($conn, $sql) or die(mysqli_error());
        
        // 4. Check whether the (Query is executed ) data is inserted or not and display appropriate message

        if ($res == TRUE)
            {
                // create a session variable to dispaly message
                $_SESSION['add'] = 'Admin Added Successfully';
                // redirect to manage admin page
                header('location:'.SETURL.'admin/manage-admin.php');
            }
        else 
            //echo "not inserted";
            {
                $_SESSION['add'] = 'Failed to Add Admin';
                // redirect to manage admin page
                header('location:'.SETURL.'admin/add-admin.php');
            }
    }
?>
