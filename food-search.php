<?php include('partials-front/navbar.php') ;?>

    <!--food search section starts here-->
    <section class="food-search text-center">
            
        <div class="container">
            
            <?php 
                               
                // Get the search keyword 
                $search = $_POST['search'];
                
                ?>
                
                <h2>Search Results: "<?php echo $search; ?>" </h2>
        </div>        
    </section>   
    <!--food search section ends here-->



    <!--food menu section starts here-->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Menu</h2> 

                <?php
                // sql query to get food based on search keyword;
                $sql = "SELECT * FROM tbl_food WHERE title LIKE '%$search%' OR description LIKE '%$search%'";

                // execute the query 
                $res = mysqli_query($conn, $sql);

                // count rows 
                $count = mysqli_num_rows($res);

                // check whether food available or not 
                if ($count >0)
                {
                    // food available 
                    while ($row=mysqli_fetch_assoc($res))
                    {
                        // get the details 
                        $id = $row['id'];
                        $title = $row['title'];
                        $price = $row['price'];
                        $description = $row['description'];
                        $image_name = $row['image_name'];

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
                                        <img src="<?php echo SETURL;?>images/food/<?php echo $image_name; ?>" class="img-responsive img-curve" width=150px>
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

                                <a href="<?php echo SETURL;?>/order.php" class="btn btn-primary">Order Now</a>
                            </div>
                            <div class="clearfix"></div>
                        </div>

                        <?php
                    }   
                }
                else
                {
                echo '<div class="error">Food Not Found :( </div>';
                }
            ?>
             
             <div class="clearfix"></div>
        </div>

    </section>
    <!--food menu section ends here-->
    

<?php include('partials-front/footer.php'); ?>