<?php include('partials-front/navbar.php');?>

    <!--food search section starts here-->
    <section class="categories text-center">
        <div class="container">

            <h2 class="text-center text-white">Fill this form to complete order.</h2>

            <form action="#" class="order">
                <fieldset>
                    <legend>Selected Food</legend>

                    <div class="food-menu-img">
                        <img src="images/pizza.jpg" alt="Chicken Hawaian Pizza" class="img-responsive img-curve">
                    </div>

                    <div class="food-menu-desc">
                        <h3>Food Title</h3>
                        <p class="food-price">$2.3</p>

                        <div class="order-label">Quantity</div>
                        <input type="number" name="qty" class="input-responsive text-center" value="1" required>

                    </div>

                </fieldset>

                <fieldset>
                    <legend>Delivery Details</legend>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="full-name" placeholder="Enter your name" class="input-responsive"
                        required>

                    <div class="order-label">Phone Number &nbsp;</div>
                    <input type="tel" maxlength='10' name="contact" placeholder="E.g. +977 9843xxxxxx" class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="abc@xyz.com" class="input-responsive"
                        required>

                    <div class="order-label">Address</div>
                    <textarea name="address" rows="5" placeholder="E.g. Street, City, Country" class="input-responsive"
                        required></textarea>

                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                </fieldset>

            </form>
        </div>

    </section>
    <!--food search section ends here-->

    <?php include('partials-front/footer.php');?>