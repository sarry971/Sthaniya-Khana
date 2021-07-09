<?php include('partials-front/navbar.php') ;?>

    <!--food search section starts here-->
    <section class="food-search text-center">
        <h2>Welcome to Sthaniya</h2>
        <h2>Khana</h2>
        <div class="container">
            <form action="<?php echo SETURL;?>food-search.php" method='POST'>
                <input type="search" name="search" placeholder="Search for food.." required>
                <button type="submit" name='submit' class="btn btn-primary">Search</button>
            </form>
        </div>

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

    <!--food menu section starts here-->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Menu</h2>
            <?php
                // getting the food from the database that are actie and featured

                // SQL query
                $sql2 = "SELECT * FROM tbl_food WHERE active ='Yes' AND featured = 'Yes' LIMIT 6";

                // execute the query
                $res2 = mysqli_query($conn, $sql2);

                //count rows
                $count2 = mysqli_num_rows($res2);

                // check if food available or not 
                if ($count2>0)
                {
                    // food available 
                    while($row = mysqli_fetch_assoc($res2))
                    {
                        $id = $row['id'];
                        $title = $row['title'];
                        $price = $row['price'];
                        $description = $row['description'];
                        $image_name = $row['image_name'];
                        ?>
                            <div class="food-menu-box">
                                <div class="food-menu-img">
                                    <?php
                                        // check if the image is available or not
                                        if ($image_name =="")
                                        {
                                            echo '<div class="error">Image not available. Stay Tuned!</div>';
                                        }
                                        else 
                                        {?>
                                            <img src="<?php echo SETURL; ?>images/food/<?php echo $image_name; ?>" class="img-responsive img-curve">   
                                            <?php
                                        }
                                    ?>
                                   
                                </div>

                            <div class="food-menu-desc">
                                <h4><?php echo $title; ?></h4>
                                <p class="food-price">Rs. <?php echo $price; ?></p>
                                <p class="food-details">
                                    <?php echo $description; ?>
                                </p>
                                <br>

                            <a href="<?php echo SETURL;?>/order.php" class="btn btn-primary">Order Now</a>
                            
                        </div>
                        <div class="clearfix"></div>
                        </div>
                        <?php
                    }
                }
                else 
                {
                    // food not available 
                    echo '<div class="error">Food not available. Stay Tuned!</div>';
                }
            ?>
            <div class="clearfix"></div>
        </div>

    </section>
    <!--food menu section ends here-->
<?php include('partials-front/footer.php') ;?>