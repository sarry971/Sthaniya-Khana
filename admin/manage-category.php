<!--Navbar section starts-->
<?php include('partials/navbar.php')?>
<!--Navbar section starts-->

<!--Main Category starts-->
    <div class="main-content">
        <div class="wrapper">
            <h1>Manage Category</h1>
            <br>

            <?php

                if(isset($_SESSION['add']))
                {
                    echo $_SESSION['add'];
                    unset($_SESSION['add']);
                }

                if(isset($_SESSION['upload']))
                {
                    echo $_SESSION['upload'];
                    unset($_SESSION['upload']);
                }

                if (isset($_SESSION['remove']))
                {
                    echo $_SESSION['remove'];
                    unset($_SESSION['remove']);
                }

                if(isset($_SESSION['delete']))
                {
                    echo $_SESSION['delete'];
                    unset($_SESSION['delete']);
                }

                if (isset($_SESSION['no-category-found']))
                {
                    echo $_SESSION['no-category-found'];
                    unset($_SESSION['no-category-found']);
                }

                if (isset($_SESSION['update']))
                {
                    echo $_SESSION['update'];
                    unset($_SESSION['update']);
                }

                if (isset($_SESSION['ext-error']))
                {
                    echo $_SESSION['ext-error'];
                    unset($_SESSION['ext-error']);
                }

                if (isset($_SESSION['failed-img-upload']))
                {
                    echo $_SESSION['failed-img-upload'];
                    unset($_SESSION['failed-img-upload']);
                }

                if (isset($_SESSION['failed-remove']))
                {
                    echo $_SESSION['failed-remove'];
                    unset($_SESSION['failed-remove']);
                }
            ?> 
            <br>

                <!--Button to Add Admin-->
                <a href="<?php echo SETURL; ?>admin/add-category.php" class="btn-primary">Add Category</a>

                <br><br><br>
                <table class="tbl-full text-center">
                    <tr>
                        <th>S.N</th>
                        <th>Image</th>
                        <th>Title</th>                        
                        <th>Featured</th>
                        <th>Active</th>
                        <th>Actions</th>
                    </tr>

                    <?php
                        // Query to select all categories from database
                        $sql = "SELECT * FROM tbl_category";

                        // execute the Query
                        $res = mysqli_query($conn, $sql);

                        // count rows 
                        $count = mysqli_num_rows($res);

                        // create SN variable and assign as 1;
                        $sn = 1;

                        // check whether we have data in database or not
                        if ($count>0)
                        {
                            // we have data in database
                            // get the data and display
                            while ($row = mysqli_fetch_assoc($res))
                            {
                                $id = $row['id'];
                                $title = $row['title'];
                                $image_name = $row['image_name'];
                                $featured = $row['featured'];
                                $active = $row['active'];

                                ?>
                                
                                    <tr>
                                        <td><?php echo $sn++;?>.</td>

                                        <td>
                                            <?php 

                                                // check whether the image name is available or not
                                                if ($image_name !="")
                                                {
                                                    //display the image;
                                                    ?>
                                                    <img src="<?php echo SETURL;?>images/category/<?php echo $image_name;?>" width='100px'>
                                                    <?php
                                                }
                                                else 
                                                {   
                                                    // display the message
                                                    echo '<div class="error">Image not Added.</div>';
                                                }
                                            ?>
                                            
                                         </td>

                                        <td><?php echo $title;?></td>
                                        <td><?php echo $featured;?></td>
                                        <td><?php echo $active;?></td>
                                        <td>
                                            <a href="<?php echo SETURL;?>admin/update-category.php?id=<?php echo $id;?>&image_name=<?php echo $image_name; ?>" class="btn-secondary">Update Category</a>
                                            <a href="<?php echo SETURL;?>admin/delete-category.php?id=<?php echo $id;?>&image_name=<?php echo $image_name; ?>" class="btn-danger">Delete Category</a>
                                        </td>
                                    </tr>
                                <?php
                            }

                        }
                        else 
                        {
                            // dont have data 
                            // display the mesage inside the table
                            ?>
                                <tr>
                                    <td colspan='6'> <div class="error">No Category Added.</div></td>    
                                </tr>

                            <?php
                                
                            
                        }

                    ?>

                    
                </table>
                <div class="clearfix"></div>

        </div>
    </div>

<!--Main Category ends>

<!--Footer starts-->
<?php include('partials/footer.php') ?>        
        <!--Footer section ends-->