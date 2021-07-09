<?php include('partials-front/navbar.php'); ?>

  

<?php 
    
    // check whether id is passed or not 
    if (isset($_GET['category_id']))
    {
        // category id is set and get the id 
        $category_id = $_GET['category_id'];
        // get the category title based on category id 
        $sql = "SELECT title from tbl_category WHERE id = $category_id";

        // execute the query
        $res = mysqli_query($conn,$sql);

        // get the value from database 
        $row = mysqli_fetch_assoc($res);
        // get the title 
        $category_title = $row['title'];
        

    }
    else 
    {
        // category not passed 
        // redirect ot home page 
        header('location:'.SETURL);
    }
  
  ?>

  <!--food search section starts here-->
  <section class="food-search text-center">
        <h2><?php echo $category_title; ?></h2>

   </section>
    <!--food search section ends here-->

    <!--food menu section starts here-->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Explore Foods of <?php echo $category_title;?></h2>
            
            <?php
                // create SQL Query to display categories from database
                $sql2 = "SELECT * FROM tbl_food WHERE category_id = $category_id";

                // Execute the Query
                $res2 = mysqli_query($conn, $sql2);

                // count rows to check wether the category is avaliable or not 
                $count2 = mysqli_num_rows($res2);

                if ($count2>0)
                {
                    // food available 
                    while ($row2=mysqli_fetch_assoc($res2))
                    {
                        // get the details 
                        $id = $row2['id'];
                        $title = $row2['title'];
                        $price = $row2['price'];
                        $description = $row2['description'];
                        $image_name = $row2['image_name'];

                        ?>
                        <div class="food-menu-box">
                            <div class="food-menu-img">
                                <?php 
                                        // chechk whether the image is available or not 
                                    if ($image_name =="")
                                    {
                                        // image not available 
                                        echo '<div class="error">Image name not available. Stay Tuned!</div>';
                                    }
                                    else 
                                    {
                                        // image not available 
                                        ?>
                                        <img src="<?php echo SETURL;?>images/food/<?php echo $image_name; ?>" class="img-responsive img-curve" width = 150px>
                                    <?php    
                                    }
                                ?>
                            </div>
                            <div class="food-menu-desc">
                                <h4><?php echo $title?></h4>
                                <p class="food-price">Rs. <?php echo $price?></p>
                                <p class="food-details">
                                    <?php echo $description; ?>
                                </p>
                                <br>

                                <a href="<?php echo SETURL;?>order.php?food_id=<?php echo $id;?>" class="btn btn-primary">Order Now</a>
                            </div>
                            <div class="clearfix"></div>
                        </div>

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