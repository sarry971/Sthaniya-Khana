<!--Navbar section starts-->
<?php include('partials/navbar.php')?>
<!--Navbar section starts-->

<!--Main Category starts-->
    <div class="main-content">
        <div class="wrapper">
            <h1>Manage Food</h1>
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
                if(isset($_SESSION['extension-mismatch']))
                {
                    echo $_SESSION['extension-mismatch'];
                    unset($_SESSION['extension-mismatch']);
                }
                if(isset($_SESSION['unauth']))
                {
                    echo $_SESSION['unauth'];
                    unset($_SESSION['unauth']);
                }
                if(isset($_SESSION['upload-fail']))
                {
                    echo $_SESSION['upload-fail'];
                    unset($_SESSION['upload-fail']);
                }
                if(isset($_SESSION['delete']))
                {
                    echo $_SESSION['delete'];
                    unset($_SESSION['delete']);
                }
                if (isset($_SESSION['upload']))
                {
                    echo $_SESSION['upload'];
                    unset ($_SESSION['upload']);
                }
                if (isset($_SESSION['ext-mismatch']))
                {
                    echo $_SESSION['ext-mismatch'];
                    unset($_SESSION['ext-mismatch']);
                }
                if (isset($_SESSION['update']))
                {
                    echo $_SESSION['update'];
                    unset($_SESSION['update']);
                }
            ?>
            <br>
                <!--Button to Add Admin-->
                <a href="<?php echo SETURL;?>admin/add-food.php" class="btn-primary">Add Food</a>

                <br><br><br>
                <table class="tbl-full text-center" >
                    <tr>
                        <th>S.N</th>
                        <th></th>
                        <th>Image</th>
                        <th>Title</th>                        
                        <th>Price</th>
                        <th>Featured</th>
                        <th>Active</th>
                        <th>Actions</th>
                    </tr>

                    <?php

                        // create a SQL Query to get all the food
                        $sql = "SELECT * FROM tbl_food";

                        $res = mysqli_query($conn, $sql);

                        $count = mysqli_num_rows($res);
                        
                        $sn = 1;
                        
                        if ($count>0)
                        {
                            // we have food in database 
                            while ($row = mysqli_fetch_assoc($res))
                            {
                                $id = $row['id'];
                                $title =$row['title'];
                                $price = $row['price'];
                                $image_name = $row['image_name'];
                                $featured = $row['featured'];
                                $active = $row['active'];
                                
                                ?>
                                    <tr>
                                        <td><?php echo $sn++;?>.<td>
                                        
                                        <td>
                                            <?php 

                                                // check whether the image name is available or not
                                                if ($image_name !="")
                                                {
                                                    //display the image;
                                                    ?>
                                                    <img src="<?php echo SETURL;?>images/food/<?php echo $image_name;?>" width='100px'>
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
                                        <td><?php echo "Rs. ".$price;?></td>
                                        <td><?php echo $featured;?></td>
                                        <td><?php echo $active;?></td>
                                        <td>
                                            <a href="<?php echo SETURL;?>admin/update-food.php?id=<?php echo $id;?>&image_name=<?php echo $image_name;?>" class="btn-secondary">Update Food</a>
                                            <a href="<?php echo SETURL;?>admin/delete-food.php?id=<?php echo $id;?>&image_name=<?php echo $image_name;?>" class="btn-danger">Delete Food</a>
                                        </td>
                                    </tr>
                                
                                <?php
                            }
                        }
                        else 
                        {
                            // food not added in database
                            //echo "<tr><td colspan='7'><div class ='error'> Food not added yet.</div></td></tr>";
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