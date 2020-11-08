<?php
    require_once(VIEWS_PATH."nav-client.php")
?>
<main>
    <div class="mt-5">
        <form action="<?php echo FRONT_ROOT ?>Ticket/AddTicket" method="POST" class="login-form text-center">
            <h1 class="mb-5 font-weight-light text-uppercase">BUY TICKET</h1>
            <input type="hidden" name="cinemaName" value="<?php echo $cinemaName ?>">
            <input type="hidden" name="idFunction" value="<?php echo $idFunction ?>">
            <input type="hidden" name="functionDate" value="<?php echo $functionDate ?>">
            <input type="hidden" name="functionStart" value="<?php echo $functionStart ?>">
            <input type="hidden" name="ticketValue" value="<?php echo $ticketValue ?>">
            <div class="form-group col-md-6">
                    <input type="number" name="quantity" class="form-control form-control-lg" placeholder="Quantity" 
                    value="<?php if(isset($data['quantity'])) echo $data['quantity']; ?>" required min=0 max=10>
            </div>
            <button type="submit" class="btn mt-5 btn-lg btn-custom btn-block text-uppercase" >Buy Ticket</button>
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