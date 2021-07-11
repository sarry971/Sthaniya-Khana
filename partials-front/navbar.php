<?php include('config/constants.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <!--important to make website responsive-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css"
    integrity="sha384-SZXxX4whJ79/gErwcOYf+zWLeJdY/qpuqC4cAa9rOGUstPomtqpuNWT9wdPEn2fk" crossorigin="anonymous">
    <link rel="icon" href="../images/favicon.jpg" type="image/x-icon">
    <link rel="stylesheet" href="css/style.css">
    <title>Sthaniya Khana</title>
</head>

<body>
    <!--navbar section starts here-->
    <section class="navbar">
        <div class="container">
            <div class="logo">
               <a href="<?php echo SETURL; ?>"><img src="images/logo-image.jpg" alt="Sthaniya Khana - Logo" class='img-responsive'></a> 
            </div>

            <div class="menu text-right">
                <ul>
                    <li>
                        <a href="<?php echo SETURL;?>">Home</a>
                    </li>
                    <li>
                        <a href="<?php echo SETURL; ?>categories.php">Categories</a>
                    </li>
                    <li>
                        <a href="<?php echo SETURL; ?>foods.php">Foods</a>
                    </li>
                    <li>
                        <a href="<?php echo SETURL; ?>contact.php">Contact</a>
                    </li>
                </ul>
            </div>
            <div class="clearfix"></div>
        </div>
    </section>
    <!--navbar section ends here-->