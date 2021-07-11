<?php include('partials-front/navbar.php') ;?>

<div class="categories">
    <div class="container">
        <?php
            if(isset($_SESSION['pay']))
            {
                echo $_SESSION['pay'];
                unset ($_SESSION['pay']);
            }
        ?>
        <h1 class="text-center">Thank you!</h1>
        <h1 class="text-center">Your order has been recieved</h1>
        <p class="text-center">
            <b>Your Token Number: <a href="#"><?php echo rand(00000,99999); ?></a> </b><br>
            Please Keep this Token number for your records<br> <br><br>
        </p>

        <p class = "text-center">You will receive a confirmation email with your token number which you will while recieving your order for verification.</p>
    
    <?php 
        
        header('refresh: 10; url='.SETURL);
    ?>
    </div>
</div>

<?php include('partials-front/footer.php') ;?>