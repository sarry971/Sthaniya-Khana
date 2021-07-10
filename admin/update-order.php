<?php include('partials/navbar.php'); ?>

<div class="main-content">
    <div class="wrapper">
    <h1>Update Order</h1>
    <br><br>

    <?php 
        // check whether id is set or not 
        if (isset($_GET['id']))
        {
            // Get the order details 
            $id = $_GET['id'];

            // SQL query to get other details 
            $sql = "SELECT * FROM tbl_order WHERE id = $id";

            // execute the query 
            $res = mysqli_query($conn, $sql);

            // count the rows
            $count = mysqli_num_rows($res);

            if ($count ==1 )
            {
                // details available 
                while ($row = mysqli_fetch_assoc($res))
                {
                    $food = $row['food'];
                    $price = $row['price'];
                    $qty = $row['qty'];
                    $status = $row['status'];
                    $customer_name = $row['customer_name'];
                    $customer_contact = $row['customer_contact'];
                    $customer_email = $row['customer_email'];
                    $customer_address = $row['customer_address'];
                }
                

            }
            else 
            {
                // details not available
                // redirect to manage-details page.
                header('location:'.SETURL.'admin/manage-order.php');
            }

        }
        else 
        {
            // redirect to manage-food page
            header("location:".SETURL.'admin/manage-order.php');
        }
    ?>
    <form action="" method="POST">
        <table class='tbl-30'>
            <tr>
                <td>Food Name:</td>
                <td><?php echo $food; ?></td>
            </tr>
            <tr>
                <td>Price:</td>
                <td><?php echo $price; ?></td>
            </tr>
            <tr>
                <td>Quantity:</td>
                <td>
                    <input type="number" name="qty" value = "<?php echo $qty;?>">
                </td>
            </tr>
            <tr>
                <td>Status:</td>
                <td>
                    <select name="status">
                        <option value="Ordered">Ordered</option>
                        <option value="On Delivery">On Delivery</option>
                        <option value="Delivered">Delivered</option>
                        <option value="Cancelled">Cancelled</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Customer Name:</td>
                <td>
                    <input type="text" name="customer_name" value="<?php echo $customer_name;?>">
                </td>
            </tr>
            <tr>
                <td>Customer Contact:</td>
                <td>
                    <input type="text" name="customer_contact" value="<?php echo $customer_contact ;?>">
                </td>
            </tr>
            <tr>
                <td>Customer Email:</td>
                <td>
                    <input type="text" name="customer_email" value="<?php echo $customer_email ;?>">
                </td>
            </tr>
            <tr>
                <td>Customer Address:</td>
                <td>
                    <textarea  name="customer_address" cols="30" rows="5" style="padding:0.5rem;"><?php echo $customer_address ;?></textarea>
                </td>
            </tr>
            <tr>
                <td colspan='2'>
                    <input type="hidden" name="id" value = "<?php echo $id ;?>">
                    <input type="hidden" name="price" value = "<?php echo $price; ?>">
                    <button type="submit" name='submit' class='btn-secondary'>Update</button>
                </td>
            </tr>
        </table>
    </form>
    
    <?php
        
        // check if ther button is clicked
        if (isset($_POST['submit']))
        {
            // echo "clciked";
            // Get all the values from form
            $id = $_POST['id'];
            $food = $_POST['food'];
            $qty = $_POST['qty'];
            $price = $_POST['price'];

            $total = $qty * $price ;
            
            $status = $_POST['status'];
            
            $customer_name = $_POST['customer_name'];
            $customer_contact = $_POST['customer_contact'];
            $customer_email = $_POST['customer_email'];
            $customer_address = $_POST['customer_address'];

            // update the values 

            $sql2 = "INSERT INTO tbl_food SET 
                qty = $qty,
                status = '$status',
                customer_name = '$customer_name',
                customer_contact = '$customer_contact',
                customer_email = '$customer_email',
                customer_address = '$customer_address',
                total = $total
                WHERE id = $id
            ";

            // execute the query
            $res2 = mysqli_query($conn, $sql2);

            // check if query is updated or not 
            if ($res2 == true)
            {
                // if query is updated 
                $_SESSION['updated'] = '<div class="success">Order Has been Updated</div>';
                header('location:'.SETURL.'admin/manage-order.php');
            }
            else
            {
                
                // if query is updated 
                $_SESSION['updated'] = '<div class="error">Failed to updated order.</div>';
                header('location:'.SETURL.'admin/manage-order.php');
            }
        }
    ?>

    </div>
</div>

<?php include('partials/footer.php'); ?>