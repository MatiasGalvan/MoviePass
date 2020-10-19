<?php
    require_once(VIEWS_PATH."nav-admin.php")
?>
<main>
    <div class="d-flex justify-content-center align-items-center login-container">
        <form action="<?php echo FRONT_ROOT ?>Cinema/RemoveCinema" method="POST" class="login-form text-center">
            <h1 class="mb-5 font-weight-light text-uppercase">Remove Cinema</h1>
            <div class="form-group">
                <input type="number" name="id" class="form-control form-control-lg" placeholder="ID" required>
            </div>
            <button type="submit" class="btn mt-5 btn-lg btn-custom btn-block text-uppercase">Remove</button>
        </form>

    </div>
</main>