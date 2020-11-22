<?php
    require_once(VIEWS_PATH."nav-admin.php")
?>
<div class="container">
        <div class="row">
            <div class="col-lg-12">
                <table id="statistics" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>Cinema</th>
                            <th>Movie</th>
                            <th>Date</th>
                            <th>Total Tickets</th>
                            <th>Remainder Tickets</th>
                            <th>Sold Tickets</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach($response as $function){ ?>
                        <tr>
                            <td class="align-middle"><?php echo $function["cinema"] ?></td>
                            <td class="align-middle"><?php echo $function["movie"] ?></td>
                            <td class="align-middle"><?php echo $function["date"] ?></td>
                            <td class="align-middle"><?php echo $function["totalTickets"] ?></td>
                            <td class="align-middle"><?php echo $function["availableTickets"] ?></td>
                            <td class="align-middle"><?php echo $function["remainder"] ?></td>
                            <td class="align-middle"><?php echo "$".$function["total"] ?></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>