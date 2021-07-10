<!--Navbar section starts-->
<?php include('partials/navbar.php')?>
<!--Navbar section starts-->

<!--Main Category starts-->
    <div class="main-content">
    <div class="wrapper">
            <h1>Manage Order</h1>
            <br>
                <!--Button to Add Admin-->
            <?php

                if (isset($_SESSION['updated']))
                {
                    $_SESSION['updated'];
                    unset($_SESSION['updated']);
                }
            ?>
                <table class="tbl-full">
                    <tr>
                        <th>S.N</th>
                        <th>Food</th>
                        <th>Price</th>
                        <th>Qty.</th>
                        <th>Total</th>
                        <th>Order Date</th>
                        <th>Status</th>
                        <th>Customer Name</th>
                        <th>Customer Contact</th>
                        <th>Customer Email</th>
                        <th>Customer Address</th>
                        <th>Actions</th>
                    </tr>
                    <?php 

                        // get all the orders from database 
                        $sql = "SELECT * FROM tbl_order ORDER BY id DESC"; // display the latest order at first

                        // execute the query
                        $res = mysqli_query($conn, $sql);

                        //count number of rows 
                        $count = mysqli_num_rows($res);
                        
                        $sn =1;
                        if ($count>0)
                        {
                            // order available
                            while ($row = mysqli_fetch_assoc($res))
                            {
                                $id = $row['id'];
                                $food = $row['food'];
                                $price = $row['price'];
                                $qty = $row['qty'];
                                $order_date = $row['order_date'];
                                $status = $row['status'];
                                $customer_name = $row['customer_name'];
                                $customer_contact = $row['customer_contact'];
                                $customer_email = $row['customer_email'];
                                $customer_address = $row['customer_address'];
                                $total = $row['total'];

                                ?>
                                <tr>
                                    <td><?php echo $sn++; ?></td>
                                    <td><?php echo $food; ?></td>
                                    <td><?php echo $price; ?></td>
                                    <td><?php echo $qty; ?></td>
                                    <td><?php echo $total; ?></td>
                                    <td><?php echo $order_date; ?></td>
                                    
                                    <td>
                                        <?php 
                                            // ordered, on delivery, delivered, cancelled
                                            if ($status == "Ordered")
                                            {
                                                echo "<label>$status</label>";
                                            }
                                            else if ($status == "On Delivery")
                                            {
                                                echo "<label style='color: orange'>$status</label>";
                                            }
                                            else if ($status == "Delivered")
                                            {
                                                echo "<label style='color: green'>$status</label>";
                                            }
                                            else if ($status == "Cancelled")
                                            {
                                                echo "<label style='color: red'>$status</label>";
                                            }
                                        ?>
                                    </td>

                                    <td><?php echo $customer_name; ?></td>
                                    <td><?php echo $customer_contact; ?></td>
                                    <td><?php echo $customer_email; ?></td>
                                    <td><?php echo $customer_address; ?></td>
                                    <td>
                                        <a href="<?php echo SETURL;?>admin/update-order.php?id=<?php echo $id; ?>" class="btn-secondary">Update Order</a>
                                        
                                    </td>
                                </tr>
                             <?php   
                            }
                        }
                        else 
                        {
                            // order not available 
                            echo "<tr><td colspan='11' class ='error'>Orders not available.</td></tr>";
                        }
                    
                    ?>

                </table>
                <div class="clearfix"></div>

        </div>
    </div>

<!--Main Category ends>

<!--Footer starts-->
<?php include('partials/footer.php') ;?>        