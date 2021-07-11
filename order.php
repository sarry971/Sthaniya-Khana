<?php include('partials-front/navbar.php');?>

    
    <!--food search section starts here-->
    <section class="categories text-center">
        <div class="container">

            <h2 class="text-center">Fill this form to complete order.</h2>

            <?php

                

                if (isset($_GET['food_id']))
                {
                    // get food id and details of the food id 
                    $food_id = $_GET['food_id'];

                    // get the details of the selected food 
                    $sql = "SELECT * FROM tbl_food WHERE id =$food_id";
                    // execute the query
                    $res = mysqli_query($conn, $sql);
                    // count the rows 
                    $count = mysqli_num_rows($res);
                    if ($count == 1)
                    {
                        // get the data
                        $row= mysqli_fetch_assoc($res);
                        $title = $row['title'];
                        $image_name = $row['image_name'];
                        $price = $row['price'];
                    }
                    else 
                    {
                        // food not available 
                        // redirect to homepage
                        header('location:'.SETURL);
                    }
                }
                else 
                {
                    // redirect to home page 
                    header('location:'.SETURL);
                }
            ?>
            <form action="" method ="POST" class="order">
                <fieldset>
                    <legend>Selected Food</legend>

                    <div class="food-menu">
                        <div class="food-menu-img">
                            <?php

                               //check whether the image is available or not 
                               if ($image_name =="")
                               {
                                   // iamge is not available
                                   echo '<div class="error">Image not available :(</div>';
                               }
                               else 
                               {
                                   // image is available
                                   ?>
                                    <img src="<?php echo SETURL;?>images/food/<?php echo $image_name?>" class="img-responsive img-curve">
                                    <?php
                               }

                            ?>
                           
                        </div>
                    </div>

                    <div class="food-menu-desc">
                        <h3><?php echo $title;?></h3><br>
                        <input type="hidden" name="food" value="<?php echo $title;?>">

                        <p>Rs.<?php echo " ".$price;?></p><br>
                        <input type="hidden" name="price" value="<?php echo $price;?>">       

                        <div class="order-label">Quantity</div>
                        <input type="number" name="qty" class="input-responsive text-center" value="1" required>

                    </div>

                </fieldset>

                <fieldset>
                    <legend>Delivery Details</legend>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="full-name" placeholder="Enter your name" class="input-responsive"  required>

                    <div class="order-label">Phone Number &nbsp;</div>
                    <input type="tel" maxlength='10' name="contact" placeholder="E.g. +977 9843xxxxxx" class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="abc@xyz.com" class="input-responsive" required>

                    <div class="order-label">Address</div>
                    <textarea name="address" rows="5" placeholder="E.g. Street, City, Country" class="input-responsive" required></textarea>

                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                </fieldset>

            </form>
            <?php 
                // check if the sbumit button is clicked or not 
                if (isset($_POST['submit']))
                {
                    //echo "clicked";
                    
                    $food = $_POST['food'];
                    $price = $_POST['price'];
                    $qty = $_POST['qty'];
                    
                    $order_date = date("Y-m-d h:i:sa"); // order date

                    $status = 'Ordered'; // ordered, On delivery, delivered, cancelled

                    $customer_name = $_POST['full-name'];
                    $customer_contact = $_POST['contact'];
                    $customer_email = $_POST['email'];
                    $customer_address = $_POST['address'];

                    $total = $qty * $price ; 

                    // save the order into the database 
                    // create SQL to save the data 
                    $sql2 = "INSERT INTO tbl_order SET
                        food = '$food',
                        price = $price,
                        qty = $qty,
                        order_date = '$order_date',
                        status = '$status',
                        customer_name = '$customer_name',
                        customer_contact = '$customer_contact',
                        customer_email = '$customer_email',
                        customer_address = '$customer_address',
                        total = $total
                    ";

                    // execute the query
                    $res2 = mysqli_query($conn,$sql2);

                    
                    
                    // check if the query is executed or not
                    if ($res2 == true)
                    {
                        // query executed and order saved 
                        $_SESSION['order'] ='<div class="success text-center">Your order has been placed successfully.Pay Now to confirm your Order</div>';

                        // get the order id 
                        $sql3 = "SELECT id FROM tbl_order";

                        // execute the query
                        $res3 =mysqli_query($conn, $sql3);

                        // fetch current row
                        $row3 = mysqli_fetch_assoc($res3);

                        // get the order id
                        $order_id = $row3['id'];

                        // redirect to payment page
                        header('location:'.SETURL.'payment.php?order_id='.$order_id);
                    }
                    else 
                    {
                        $_SESSION['order-failed'] ='<div class="error text-center">Failed to place order. Please Try Again</div>';
                        header('location:'.SETURL);
                    }
                }
            ?>
        </div>

    </section>
    <!--food search section ends here-->

    <?php include('partials-front/footer.php');?>