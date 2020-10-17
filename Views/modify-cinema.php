<main>
    <div class="d-flex justify-content-center align-items-center login-container">
        <form action="<?php echo FRONT_ROOT ?>Cinema/ModifyCinema" method="POST" class="login-form text-center">
            <h1 class="mb-5 font-weight-light text-uppercase">Modify Cinema</h1>
            <div class="form-group">
                <input type="number" name="id" class="form-control form-control-lg" placeholder="ID" required>
            </div>
            <button type="submit" class="btn mt-5 btn-lg btn-custom btn-block text-uppercase">Modify</button>
        </form>

    </div>
</main>