<?php
    require_once(VIEWS_PATH."nav-client.php")
?>

<script type="text/javascript">
    function calculateSubtotal(ticketValue){
        var quantity = document.getElementById('quantity').value;
        var final = document.getElementById('finalValue');

        var result = ticketValue * quantity;

        final.value = result; 

    }
</script>

<main>
    <div class="mt-3">
        <form action="<?php echo FRONT_ROOT ?>Ticket/AddTicket" method="POST" class="login-form text-center">
            <h1 class="mb-3 font-weight-light text-uppercase">BUY TICKET</h1>
            <input type="hidden" name="cinemaName" value="<?php echo $cinemaName ?>">
            <input type="hidden" name="idFunction" value="<?php echo $idFunction ?>">
            <input type="hidden" name="functionDate" value="<?php echo $functionDate ?>">
            <input type="hidden" name="functionStart" value="<?php echo $functionStart ?>">
            <input type="hidden" name="ticketValue" value="<?php echo $ticketValue ?>">


     
            <div class="form-group">
                <input type="number" id="quantity" name="quantity" class="form-control form-control-lg" placeholder="Quantity" 
                value="<?php if(isset($data['quantity'])) echo $data['quantity']; ?>" required min=0 max=10>
            </div>
        

            <div class="form-row">
                <div class="form-group col-md-6">
                    <input type="text" name="name" class="form-control form-control-lg" placeholder="Name" disabled
                    value="<?php if(isset($data['name'])) echo $data['name']; ?>">
                </div>
                <div class="form-group col-md-6">
                    <input type="text" name="lastname" class="form-control form-control-lg" placeholder="Lastname" disabled
                    value="<?php if(isset($data['lastname'])) echo $data['lastname']; ?>">
                </div>
            </div>
    
            <div class="form-group">
                <input type="text" name="creditCard" class="form-control form-control-lg" placeholder="Creditcard" 
                value="<?php if(isset($data['creditCard'])) echo $data['creditCard']; ?>" disabled>
            </div>
                    
            <div class="form-row">
                <div class="form-group col-md-6">
                    <input type="text" name="company" class="form-control form-control-lg" placeholder="Company" disabled
                    value="<?php if(isset($data['company'])) echo $data['company']; ?>">
                </div>
                <div class="form-group col-md-6">
                    <input type="text" name="securityCode" class="form-control form-control-lg" placeholder="Securitycode" disabled
                    value="<?php if(isset($data['securityCode'])) echo $data['securityCode']; ?>">
                </div>
            </div>
                    
            <div class="form-row">
                <div class="form-group col-md-6">
                    <input type="number" name="month" class="form-control form-control-lg" placeholder="Month" disabled
                    value="<?php if(isset($data['month'])) echo $data['month']; ?>" min=1 max=12>
                </div>
                <div class="form-group col-md-6">
                    <input type="number" name="year" class="form-control form-control-lg" placeholder="Year" disabled
                    value="<?php if(isset($data['year'])) echo $data['year']; ?>" min=2020 max=2030>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <input type="text" id="finalValue" name="finalValue" class="form-control form-control-lg" placeholder="Subtotal" 
                    value="" disabled>
                </div>
                <div class="form-group col-md-6">
                    <input type="button" onclick="calculateSubtotal(<?php echo $ticketValue ?>)" class="btn btn-success" value="Calculate subtotal" style="margin-top: 5px;">
                </div>
            </div>


            <button type="submit" class="btn mt-3 btn-lg btn-custom btn-block text-uppercase" >Buy Ticket</button>

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