<main>
    <div class="d-flex justify-content-center align-items-center login-container">
        <form action="<?php echo FRONT_ROOT ?>Home/Register" method="POST" class="login-form text-center">
            <h1 class="mb-5 font-weight-light text-uppercase">Sign Up</h1>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <input type="text" name="name" class="form-control rounded-pill form-control-lg" placeholder="Name" required>
                </div>
                <div class="form-group col-md-6">
                    <input type="text" name="lastname" class="form-control rounded-pill form-control-lg" placeholder="Lastname" required>
                </div>
            </div>
            <div class="form-group">
                <input type="text" name="dni" class="form-control rounded-pill form-control-lg" placeholder="DNI" required>
            </div>
            <div class="form-group">
                <input type="email" name="email" class="form-control rounded-pill form-control-lg" placeholder="Email" required>
            </div>
            <div class="form-group">
                <input type="password" name="password" class="form-control rounded-pill form-control-lg" placeholder="Password" required>
            </div>
            <button type="submit" class="btn mt-5 rounded-pill btn-lg btn-custom btn-block text-uppercase">Create account</button>
            <p class="mt-3 font-weight-normal">Already have an account? <a href="<?php echo FRONT_ROOT ?>Home/ShowLoginView"><strong>Sign in</strong></a></p>
        </form>

    </div>
</main>