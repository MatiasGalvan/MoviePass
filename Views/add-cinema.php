<main>
    <div class="d-flex justify-content-center align-items-center login-container">
        <form action="<?php echo FRONT_ROOT ?>Cinema/AddCinema" method="POST" class="login-form text-center">
            <h1 class="mb-5 font-weight-light text-uppercase">Add Cinema</h1>
            <div class="form-group">
                <input type="text" name="name" class="form-control form-control-lg" placeholder="Name" required>
            </div>
            <div class="form-group">
                <input type="text" name="address" class="form-control form-control-lg" placeholder="Address" required>
            </div>
            <div class="form-group">
                <input type="number" name="capacity" class="form-control form-control-lg" placeholder="Capacity" required>
            </div>
            <div class="form-group">
                <input type="number" name="ticketValue" class="form-control form-control-lg" placeholder="Ticket value" required>
            </div>
            <button type="submit" class="btn mt-5 btn-lg btn-custom btn-block text-uppercase">Add Cinema</button>
        </form>

    </div>
</main>