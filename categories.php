<?php include('partials-front/navbar.php');?>
    

    <!--categories section starts here-->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>
            <?php 

                // display all the categories that are active 
                // sql query
                $sql = "SELECT * FROM tbl_category WHERE active='Yes'";

                // execute the query
                $res = mysqli_query($conn, $sql);
                // count rows
                $count = mysqli_num_rows($res);
                if($count > 0)
                {
                    // categories available
                    while ($row=mysqli_fetch_assoc($res))
                    {
                        $id = $row['id'];
                        $title = $row['title'];
                        $image_name = $row['image_name'];
                        ?>
                            <a href="<?php echo SETURL;?>categories-food.php?category_id=<?php echo $id; ?>">
                                 <div class="box-1 float-container">
                                    
                                    <?php
                                    
                                        if ($image_name =='')
                                        {
                                            // image not available 
                                            echo '<div class="error">Images are not added yet. Stay Tuned!</div>';
                                        }
                                        else 
                                        {
                                            // image is available 
                                            ?>
                                            <img src="<?php echo SETURL;?>images/category/<?php echo $image_name; ?>" class="img-responsive img-curve">
                                            <?php
                                        }
                                    
                                    ?>
                                    <h3 class="float-text"><?php echo $title ;?></h3>
                                </div>
                            </a>
                        <?php
                    }
                }
                else 
                {
                    // categories not available
                    echo '<div class="error">Categories are not added yet. Stay Tuned!</div>';
                }
            ?>
            
           
            <div class="clearfix"></div>
        </div>

    </section>
    <!--categories section ends here-->

    <?php include('partials-front/footer.php');?>