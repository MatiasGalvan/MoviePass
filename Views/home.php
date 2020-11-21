<div style="height: 100vh;">
    <?php
        $url = "";
        $flag = false;

        if(!isset($_SESSION['email']) || empty($_SESSION['email'])){
            $url = "nav-unknown.php";
            $flag = true;
        }

        if($url != "") require_once(VIEWS_PATH.$url);
    ?>

    <div class="d-flex justify-content-center align-items-center <?php if(!$flag) echo "login-container"; ?>" <?php if($flag) echo "style=\"height:91%\";"; ?> >

        <form action="<?php echo FRONT_ROOT ?>Home/Login" method="POST" class="login-form text-center">

            <h1 class="mb-4 font-weight-light text-uppercase">Login</h1>
            <?php
            if(isset($message)){
                echo "<p class=\"message\">" . $message . "</p>";
            }
            ?>
            <div class="form-group">
                <input type="email" name="email" class="form-control form-control-lg" placeholder="Email" required
                value="<?php if(isset($email)) echo $email; ?>">
            </div>
            <div class="form-group">
                <input type="password" name="password" class="form-control form-control-lg" placeholder="Password" required>
            </div>

            <button type="submit" class="btn mt-4 btn-lg btn-custom btn-block text-uppercase">Log in</button>

            <p class="mt-3 font-weight-normal">Don't have an account? <a href="<?php echo FRONT_ROOT ?>Home/ShowRegistrationView"><strong>Register Now</strong></a></p>

        </form>

    </div>
    
</div>