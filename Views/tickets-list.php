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
                         <th>Cinema</th>
                         <th>Movie</th>
                         <th>Date</th>
                         <th>Start</th>
                         <th>Quantity</th>
                         <th>Value</th>
                    </thead>
                    <tbody >
                        <?php foreach($data as $ticket){ ?>
                        <tr>
                            <td class="align-middle"><?php echo $ticket["cinemaName"] ?></td>
                            <td class="align-middle"><?php echo $ticket["movie"] ?></td>
                            <td class="align-middle"><?php echo $ticket["date"] ?></td>
                            <td class="align-middle"><?php echo $ticket["time"] ?></td>
                            <td class="align-middle"><?php echo $ticket["quantity"] ?></td>
                            <td class="align-middle"><?php echo $ticket["total"] ?></td>
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