<?php include('partials/navbar.php')?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Admin</h1>
        <br><br>

        <?php 
            // 1. Get the ID of the selected Admin
                $id = $_GET['id'];
            // 2. Create SQL query to get the details
                $sql = "SELECT * FROM tbl_admin WHERE id = $id";

            // 3. execute the query
                $res = mysqli_query($conn, $sql); 

            // to check whether the query is executed or not
            if ($res == TRUE)
            {
                // check whether the data is available or not
                $count = mysqli_num_rows($res);

                if ($count == 1)
                {
                    // get the details
                    //echo 'admin selected';
                    $row = mysqli_fetch_assoc($res);
                    $full_name = $row['full_name'];
                    $username = $row['username'];
                }
                else 
                {
                    // redirect to manage-admin page
                    header('location:'.SETURL.'admin/manage-admin.php');
                }
            }
        ?>
        <form action="" method='POST'>
        <table class='tbl-30'>
            <tr>
                <td>Full Name:</td>
                <td>
                    <input type="text" name = "fullname" value="<?php echo $full_name;?>">
                </td>
            </tr>
            <tr>
                <td>Username:</td>
                <td>
                    <input type="text" name = "username" value="<?php echo $username; ?>">
                </td>
            </tr>
            <tr>
                <td colspan='2'>
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <button type="submit" class="btn-secondary" name='submit'>Update Admin</button>
                </td>
            </tr>
        </table>
        </form>
    </div>
</div>

<?php 

// to check whether the submit button is clicked or not 
if (isset($_POST['submit']))
{
    // echo "Button clicked";
    // GET all the values from form to update
    $id = $_POST['id'];
    $full_name = $_POST['fullname'];
    $username = $_POST['username'];

    // create a SQL query to update admin
    $sql = "UPDATE tbl_admin SET
        full_name = '$full_name',
        username = '$username'
        WHERE id ='$id'
        ";

    // execute the query 
    $res = mysqli_query($conn, $sql);

    // check whether the query is executed or not
    if ($res == true)
    {
        // Query executed and admin updated
        $_SESSION['update'] = "<div class='success'>Admin update successfully!!!</div>";

        // redirect to manage-admin.php page;
        
        header('location:'.SETURL.'admin/manage-admin.php');
    }
    else 
    {
        // failed to update.
        $_SESSION['update'] = '<div class="error">Failed to update Admin</div>';
        header('location:'.SETURL.'admin/manage-admin.php');
    }
}
?>

<?php include('partials/footer.php')?>