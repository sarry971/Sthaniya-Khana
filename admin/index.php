<!--Menu section starts-->
<?php include('partials/navbar.php') ?>
<!--Menu section ends-->


        
        <!--Main Content section starts-->
        <div class="main-content">
            <div class="wrapper">
                <h1>DashBoard</h1>
                <?php
                    if (isset($_SESSION['login']))
                    {
                        echo $_SESSION['login'];
                        unset($_SESSION['login']);
                    }
                ?>
                <div class="col-4 text-center">
                    
                    <?php 
                        // sql query to display categories
                        $sql = "SELECT * FROM tbl_category";

                        // execute the query
                        $res = mysqli_query($conn, $sql);

                        // count total number of rows 
                        $count = mysqli_num_rows($res);
                    ?>
                    <h1><?php echo $count;?></h1>
                    <br/>
                    Categories
                </div>
                
                <div class="col-4 text-center">
                
                    <?php 
                        // sql query to display categories
                        $sql2 = "SELECT * FROM tbl_food";

                        // execute the query
                        $res2 = mysqli_query($conn, $sql2);

                        // count total number of rows 
                        $count2 = mysqli_num_rows($res2);
                    ?>

                    <h1><?php echo $count2; ?></h1>
                    <br/>
                    Foods
                </div>

                <div class="col-4 text-center">
                
                    <?php 
                        // sql query to display categories
                        $sql3 = "SELECT * FROM tbl_order";

                        // execute the query
                        $res3 = mysqli_query($conn, $sql3);

                        // count total number of rows 
                        $count3 = mysqli_num_rows($res3);
                    ?>

                    <h1><?php echo $count3; ?></h1>
                    <br/>
                    Total Orders
                </div>

                
                <div class="col-4 text-center">

                    <?php 

                        // create SQL Query to get total revenue generated
                        // aggregate function in SQL
                        $sql4 = "SELECT SUM(total) AS Total FROM tbl_order WHERE status = 'Delivered'";
                        
                        // execute the query 
                        $res4 = mysqli_query($conn, $sql4);

                        // get the value 
                        $row4 =mysqli_fetch_assoc($res4);

                        // Get the total revenue 
                        $total_revenue = $row4['Total'];

                        
                    ?>
                    <h1>Rs. <?php echo $total_revenue;?></h1>
                    <br/>
                    Revenue Generated
                </div>
                

                <div class="clearfix"></div>

            </div>
            
        </div>
        <!--Main Content section ends-->

        
        
        <!--Footer starts-->
<?php include('partials/footer.php') ?>        
        <!--Footer section ends-->