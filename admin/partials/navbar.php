
<?php 

    $myRoot = $_SERVER["DOCUMENT_ROOT"];
    //echo $myRoot;
    include('../config/constants.php');
    include('login-check.php');

?>


<html>
    <head>
        <title>Staniya Khana- Home Page</title> 

        <link rel="icon" href="../images/favicon.jpg" type="image/x-icon">
        <link rel= "stylesheet" href="../css/admin.css">
    </head>

    <body>
        <!--Menu section starts-->
        <div class="menu text-center">
            <div class="wrapper">
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="manage-admin.php">Admin</a></li>
                    <li><a href="manage-category.php">Category</a></li>
                    <li><a href="manage-food.php">Food</a></li>
                    <li><a href="manage-order.php">Order</a></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>

            </div>    
        
        </div>
        <!--Menu section ends-->
</body>

</html>