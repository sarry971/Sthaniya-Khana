<?php include('partials-front/navbar.php');?>

    <!--food search section starts here-->
    <section class="food-search text-center">
        <h2>Order your favorite cusine</h2>
        <div class="container">
            <form action="<?php echo SETURL;?>food-search.php" method='POST'>
                <input type="search" name="search" placeholder="Search for food..">
                <button type="submit" name='submit' class="btn btn-primary">Search</button>
            </form>
        </div>

    </section>
    <!--food search section ends here-->

    <!--food menu section starts here-->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Menu</h2>

            <?php
                // display foods that are active 
                $sql = "SELECT * FROM tbl_food WHERE active ='Yes'";

                // execute the query
                $res = mysqli_query($conn, $sql);

                // count rows 
                $count = mysqli_num_rows($res);
                if ($count>0)
                {
                    while($row = mysqli_fetch_assoc($res))
                    {
                        $id = $row['id'];
                        $title = $row['title'];
                        $price = $row['price'];
                        $image_name = $row['image_name'];
                        $description = $row['description'];
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
                                        <img src="<?php echo SETURL;?>images/food/<?php echo $image_name; ?>" class="img-responsive img-curve">
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
                    echo '<div class="error">Food Not available. Stay Tuned!</div>';
                }
            ?>
            
            <div class="clearfix"></div>
        </div>

    </section>
    <!--food menu section ends here-->
    
    <?php include('partials-front/footer.php');?>