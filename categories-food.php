<?php include('partials-front/navbar.php'); ?>

  

  <?php 
    
    // check whether id is passed or not 
    if (isset($_GET['category_id']))
    {
        // category id is set and get the id 
        $category_id = $_GET['category_id'];
    }
    else 
    {
        // category not passed 
        // redirect ot home page 
        header('location:'SETURL);
    }
  
  ?>

  <!--food search section starts here-->
  <section class="food-search text-center">
        <h2>Foods on Category</h2>

   </section>
    <!--food search section ends here-->

    <!--categories section starts here-->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>
            
            <?php
                // create SQL Query to display categories from database
                $sql = "SELECT * FROM tbl_category WHERE featured ='Yes' AND active ='Yes' LIMIT 3";

                // Execute the Query
                $res = mysqli_query($conn, $sql);

                // count rows to check wether the category is avaliable or not 
                $count = mysqli_num_rows($res);

                if ($count>0)
                {
                    // categories available 
                    while($row = mysqli_fetch_assoc($res))
                    {
                        // get the values like id, image_name
                        $id = $row['id'];
                        $title = $row['title'];
                        $image_name = $row['image_name'];
                        ?>
                            
                            <a href="<?php SETURL;?>/categories-food.php?category_id=<?php echo $id;?>">
                                <div class="box-1 float-container">
                                    <?php 
                                        // check if the image is available or not 
                                        if ($image_name =='')
                                        {
                                            echo '<div class= "error">Image Not available</div>';
                                        }
                                        else 
                                        {
                                            ?>
                                            <img src="<?php echo SETURL;?>/images/category/<?php echo $image_name; ?>" class="img-responsive img-curve">
                                            <?php
                                        }
                                    ?>
                                    
                                    <h3 class="float-text"><?php echo $title; ?></h3>
                                </div>
                            </a>
                        <?php
                    }
                }
                else 
                {
                    // categories not available
                    echo '<div class="error">Category is not added Yet! Stay Tuned.</div>';
                }
            
            ?>
            

            <div class="clearfix"></div>
        </div>

    </section>
    <!--categories section ends here-->

  
<?php include('partials-front/footer.php'); ?>