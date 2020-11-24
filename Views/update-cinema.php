<div style="height: 100vh;"> 

    <?php
        require_once(VIEWS_PATH."nav-admin.php")
    ?>

    <div class="d-flex justify-content-center align-items-center" style="height: 91%;">
        <form action="<?php echo FRONT_ROOT ?>Cinema/ModifyCinema" method="POST" class="login-form text-center">
            <h1 class="mb-5 font-weight-light text-uppercase">UPDATE CINEMA</h1>

            <input type="hidden" name="id" class="form-control form-control-lg"
            value="<?php if(isset($data['id'])) echo $data['id']; ?>" required>

            <div class="form-group">
                <input type="text" name="name" class="form-control form-control-lg" placeholder="Name" 
                value="<?php if(isset($data['name'])) echo $data['name']; ?>" required>
            </div>
            <div class="form-group">
                <input type="text" name="address" class="form-control form-control-lg" placeholder="Address" 
                value="<?php if(isset($data['address'])) echo $data['address']; ?>" required>
            </div>
            <div class="form-group">
                <input type="number" name="ticketValue" class="form-control form-control-lg" placeholder="Ticket value" 
                value="<?php if(isset($data['ticketValue'])) echo $data['ticketValue']; ?>" required>
            </div>
            <button type="submit" class="btn mt-5 btn-lg btn-custom btn-block text-uppercase">Update Cinema</button>
            <?php
            if(isset($errors)){
                echo "<ul>";
                foreach ($errors as $error){
                    echo "<li class=\"message\">" . $error . "</li>";
                }
                echo "</ul>";
            }
            if(isset($message)){
                echo "<p class=\"message\">" . $message . "</p>";
            }
            ?>
        </form>

    </div>

</div>