<?php
    require_once(VIEWS_PATH."nav-client.php")
?>
<main>
    <div class="mt-5">
        <form action="<?php echo FRONT_ROOT ?>Ticket/AddTicket" method="POST" class="login-form text-center">
            <h1 class="mb-5 font-weight-light text-uppercase">ADD TICKET</h1>
            <div class="form-group">
                <input type="number" name="ticketQuantity" class="form-control form-control-lg" placeholder="ticketQuantity" 
                value="<?php if(isset($data['ticketQuantity'])) echo $data['ticketQuantity']; ?>" required>
            </div>
            <div class="form-group">
                <input type="text" name="address" class="form-control form-control-lg" placeholder="Address" 
                value="<?php if(isset($data['address'])) echo $data['address']; ?>" required>
            </div>
            <div class="form-group">
                <input type="number" name="ticketValue" class="form-control form-control-lg" placeholder="Ticket value" 
                min="0" max="9999" value="<?php if(isset($data['ticketValue'])) echo $data['ticketValue']; ?>" required>
            </div>
            <button type="submit" class="btn mt-5 btn-lg btn-custom btn-block text-uppercase">Add Cinema</button>
            <?php
            if(isset($errors)){
                echo "<ul class = \"mt-3\">";
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
</main>