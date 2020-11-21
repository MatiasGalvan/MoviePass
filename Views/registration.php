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

    <div class="d-flex justify-content-center align-items-center <?php if(!$flag)echo "login-container"; ?>" <?php if($flag) echo "style=\"height:91%\";"; ?> >
        <form action="<?php echo FRONT_ROOT ?>Home/Register" method="POST" class="login-form text-center">
            <h1 id="signUp" class="mb-4 font-weight-light text-uppercase">Sign Up</h1>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <input type="text" name="name" class="form-control form-control-lg" placeholder="Name" required
                    value="<?php if(isset($data['name'])) echo $data['name']; ?>">
                </div>
                <div class="form-group col-md-6">
                    <input type="text" name="lastname" class="form-control form-control-lg" placeholder="Lastname" required
                    value="<?php if(isset($data['lastname'])) echo $data['lastname']; ?>">
                </div>
            </div>
            <div class="form-group">
                <input type="text" name="dni" class="form-control form-control-lg" placeholder="DNI" required
                value="<?php if(isset($data['dni'])) echo $data['dni']; ?>">
            </div>
            <div class="form-group">
                <input type="email" name="email" class="form-control form-control-lg" placeholder="Email" required
                value="<?php if(isset($data['email'])) echo $data['email']; ?>">
            </div>
            <div class="form-group">
                <input type="password" name="password" class="form-control form-control-lg" placeholder="Password" required
                value="<?php if(isset($data['password'])) echo $data['password']; ?>">
            </div>
            <?php
            if(isset($errors)){
                echo "<ul>";
                foreach ($errors as $error){
                    echo "<li class=\"message\">" . $error . "</li>";
                }
                echo "</ul>";
            }
            ?>
            <button id="submitBtn" type="submit" class="btn mt-4 btn-lg btn-custom btn-block text-uppercase">Create account</button>
            <p class="mt-3 font-weight-normal">Already have an account? <a href="<?php echo FRONT_ROOT ?>Home/ShowLoginView"><strong>Sign in</strong></a></p>
        </form>
    </div>

</div>