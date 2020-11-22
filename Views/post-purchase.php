<div style="height:100vh">

    <?php
        require_once(VIEWS_PATH."nav-client.php")
    ?>

    <div class="row justify-content-center" style="height:91%; margin:0;">
            <div class="col-sm-8 align-self-center text-center">
                <div class="card shadow">
                    <div class="card-body">           
                        <i class="far fa-check-circle fa-5x" style="color:green"></i>
                        <h1 style="color:green">Thank you.</h1>
                        <h3>Your order was completed successfully.</h3>
                        <h5>An email receipt including the details about your order has been sent to the email address provided.</h5>              
                        <a href="<?php echo FRONT_ROOT ?>Movie/ShowMovies" class="mt-3 text-uppercase" style="color:green">Back to homepage</a>
                    </div>
                </div>
            </div>
    </div>
</div>  