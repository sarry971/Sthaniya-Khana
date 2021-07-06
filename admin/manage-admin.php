<!--Menu section starts-->
<?php include('partials/navbar.php'); ?>
<!--Menu section ends-->

        <!--Main Content section starts-->
        <div class="main-content">
            <div class="wrapper">
                <h1>Manage Admin</h1>
                <br>
                <?php
                    if (isset($_SESSION['add']))
                    {
                        echo $_SESSION['add'];  // displaying session message
                        unset($_SESSION['add']); // removing session message
                    }

                    if (isset($_SESSION['delete']))
                    {
                        echo $_SESSION['delete']; // displaying session message
                        unset($_SESSION['delete']); // removing session mesage
                    }

                    if (isset($_SESSION['update']))
                    {
                        echo $_SESSION['update']; // displaying session message
                        unset($_SESSION['update']); // displaying session message
                    }

                    if (isset($_SESSION['user-not-found']))
                    {
                        echo $_SESSION['user-not-found'];
                        unset($_SESSION['user-not-found']);
                    }

                    if (isset($_SESSION['password-not-match']))
                    {
                        echo $_SESSION['password-not-match'];
                        unset($_SESSION['password-not-match']);
                    }

                    if (isset($_SESSION['password-changed']))
                    {
                        echo $_SESSION['password-changed'];
                        unset($_SESSION['password-changed']);
                    }

                    
                ?>
                <br>
                <!--Button to Add Admin-->
                <a href="add-admin.php" class="btn-primary">Add Admin</a>

                <br><br><br>
                <table class="tbl-full text-center">
                    <tr>
                        <th>S.N</th>
                        <th>Full Name</th>
                        <th>Username</th>
                        <th>Actions</th>
                    </tr>
                    <?php
                        // Query for displaying all admin
                        $sql = "SELECT * FROM tbl_admin";

                        $res = mysqli_query($conn, $sql);

                        if($res == TRUE)
                        {
                            // count rows to check whether we have data in database or not
                            $count = mysqli_num_rows($res); // function to get all the rows in database

                            if ($count  > 0)
                            {
                                $sn = 1;
                            
                            // we have data in database;
                                while ($rows = mysqli_fetch_assoc($res))
                                {
                                    // using while loop to get all the data from database
                                    // and while loop will run as long as we have data in database
                                    
                                    // get individual data 
                                    $id = $rows['id'];
                                    $full_name = $rows['full_name'];
                                    $username = $rows['username'];

                                    // display the values in our table

                                    ?>

                                   <tr>
                                        <td><?php echo $sn++; ?></td>
                                        <td><?php echo $full_name; ?></td>
                                        <td><?php echo $username; ?></td>
                                        <td>
                                            <a href="<?php echo SETURL; ?>/admin/update-password.php?id=<?php echo $id;?>" class="btn-primary">Change Password</a>
                                            <a href="<?php echo SETURL; ?>/admin/update-admin.php?id=<?php echo $id;?>" class="btn-secondary">Update Admin</a>
                                            <a href="<?php echo SETURL; ?>/admin/delete-admin.php?id=<?php echo $id;?>" class="btn-danger">Delete Admin</a>
                                        </td>
                                    </tr>

                                    <?php 
                                }
                            }
                            else {
                                // we dont have data in database;
                            }
                        }
                    ?>
                
                </table>
                <div class="clearfix"></div>

            </div>
            
        </div>
        <!--Main Content section ends-->

        <!--Footer starts-->
<?php include('partials/footer.php'); ?>        
        <!--Footer section ends-->
        