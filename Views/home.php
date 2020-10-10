<div class="d-flex justify-content-center align-items-center login-container">

    <form action="<?php echo FRONT_ROOT ?>Home/Login" method="POST" class="login-form text-center">

        <h1 class="mb-5 font-weight-light text-uppercase">Login</h1>
        <div class="form-group">
            <input type="email" name="email" class="form-control form-control-lg" placeholder="Email" required>
        </div>
        <div class="form-group">
            <input type="password" name="password" class="form-control form-control-lg" placeholder="Password" required>
        </div>

        <button type="submit" class="btn mt-5 btn-lg btn-custom btn-block text-uppercase">Log in</button>

        <p class="mt-3 font-weight-normal">Don't have an account? <a href="<?php echo FRONT_ROOT ?>Home/ShowRegistrationView"><strong>Register Now</strong></a></p>

    </form>

</div>