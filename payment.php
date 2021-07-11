<?php include('partials-front/navbar.php'); ?>
    
    <?php 

        if(isset($_SESSION['order']))
        {
            echo $_SESSION['order'];
            unset($_SESSION['order']);
        }
        if(isset($_SESSION['pay']))
        {
            echo $_SESSION['pay'];
            unset($_SESSION['pay']);
        }

        
        
    ?>

<div class="categories text-center">
    <div class="container">
        
        <?php 

            if(isset($_GET['order_id']))
            {
                // get the order details
                $order_id = $_GET['order_id'];
                $sql = "SELECT * FROM tbl_order WHERE id = $order_id";

                // execute the query
                $res = mysqli_query($conn, $sql);

                // check if the query is executed or not 
                if ($res == TRUE)
                {
                    // query is executed 
                    // fetch order details 
                    while ($row= mysqli_fetch_assoc($res))
                    {
                        $title = $row['food'];
                        $qty = $row['qty'];
                        $total = $row['total'];
                        $customer_name = $row['customer_name'];
                        $customer_email = $row['customer_email'];
                        ?>

                            <h2 class="text center">Hello, <?php echo $customer_name; ?>. Pay Rs. <?php echo $total; ?>, to confirm your order <?php echo $qty." quantity ". $title; ?></h2>

                        <?php
                    }
                }
                else 
                {
                    echo "no order";
                }
            }

        ?>
        <br><br>
        <h3 class="text-center">Credit Card</h3>
        <form action="" method="POST" class="order">
            <table >
                <tr> 
                    <td>
                        Name on the card:
                    </td>
                    <td>
                        <input type="text" name="card_name" placeholder="Enter the name on your card" style="border-radius:0.4rem; padding:0.2rem; height:4vh; " required>
                    </td>
                </tr>
                <tr>
                    <td>
                        Credit Card Number:
                    </td>
                    <td>
                        <input type="tel" maxlength="14" name="credit-card-number" placeholder="XXXX XXX XXX XXXX" style="border-radius:0.4rem; padding:0.2rem;  height:4vh;" required>
                    </td>
                </tr>
                <tr>
                    <td>
                        CVV Number:
                    </td>
                    <td>
                        <input type="password" maxlength="3" name="CVV-number" placeholder="XXX" style="border-radius:0.4rem; padding:0.2rem; height:4vh; " required>
                    </td>
                </tr>
                <tr>
                    <td>
                        Expiry Date:
                    </td>
                    <td>
                        <input type="date" name="exp-date" style="border-radius:0.4rem; padding:0.2rem;  height:4vh;" required>
                    </td>
                </tr>
                <tr>
                    <td colspan='2' class="text-center">
                        <input type="hidden" name = "customer_email" value="<?php echo $customer_email?>">
                        <button type = 'submit' name = "submit" class='btn btn-primary'>Pay Now</button>
                    </td>
                </tr>
            </table>
        </form>
        <?php 

            
            if(isset($_POST['submit']))
            {
                // get the details 
                $card_name = $_POST['card_name'];
                $card_number = $_POST['credit-card-number'];
                $cvv_number = $_POST['CVV-number'];
                $expiry_date = $_POST['exp-date'];

                // sql query for the data 
                $sql2 = "INSERT INTO tbl_payment SET
                    card_name = '$card_name',
                    card_number = $card_number,
                    cvv_number = $cvv_number,
                    expiry_date = '$expiry_date'
                ";

                // execute the query
                $res2 = mysqli_query($conn, $sql2);

                // check whether the query is executed or not 
                if ($res2 == true)
                {
                    $_SESSION['pay'] = '<div class="success">You have paid!</div>';
                    header('location:'.SETURL.'delivered.php');
                }
                else
                {
                    // display query message 
                    $_SESSION['pay'] = '<div class="error">Invalid credentials</div>';
                    header('location:'.SETURL.'delivered.php');
                }
                
            }
        ?>
    </div>

</div>

<?php include('partials-front/footer.php') ;?>