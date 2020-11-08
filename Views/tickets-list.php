<?php
    require_once(VIEWS_PATH."nav-client.php")
?>

<style>
    .btn-custom {
        min-height: 20px;
    }
</style>

<div class="container">
    <h3 class="mb-4 mt-4">Tickets List</h3>
    
    <?php
        if(isset($message)){
            echo "<p class=\"message\">" . $message . "</p>";
        }
    ?>

    <div class="row justify-content-center">
        <div class="table-responsive">
            <table class="table table-striped table-dark table-bordered table-hover">
                    <thead>
                         <th>ID</th>
                         <th>Cinema Name</th>
                         <th>ID Function</th>
                         <th>Function Date</th>
                         <th>Function Start</th>
                         <th>Quantity</th>
                         <th>Final Value</th>
                    </thead>
                    <tbody >
                        <?php foreach($ticketList as $ticket){ ?>
                        <tr>
                            <td class="align-middle"><?php echo $ticket->getIdTicket() ?></td>
                            <td class="align-middle"><?php echo $ticket->getCinemaName() ?></td>
                            <td class="align-middle"><?php echo $ticket->getIdFunction() ?></td>
                            <td class="align-middle"><?php echo $ticket->getFunctionDate() ?></td>
                            <td class="align-middle"><?php echo $ticket->getFunctionStart() ?></td>
                            <td class="align-middle"><?php echo $ticket->getQuantity() ?></td>
                            <td class="align-middle"><?php echo $ticket->getFinalValue() ?></td>
                        </tr>
                        <?php } ?>
                        <?php
                            if(isset($empty)){
                                $content = "<tr><td colspan=\"7\" style=\"text-align: center;\">" . $empty . "</td></tr>";
                                echo $content;
                            }
                        ?>
                    </tbody>
            </table>
        </div>
    </div>

</div>   