<?php
    require_once(VIEWS_PATH."nav-admin.php")
?>

<style>
    .btn-custom {
        min-height: 20px;
    }
</style>

<div class="container">
    <h3 class="mb-4 mt-4">Cinemas List</h3>
    <div class="row justify-content-center">
        <div class="table-responsive">
            <table class="table table-striped table-dark table-bordered">
                    <thead>
                         <th>ID</th>
                         <th>Name</th>
                         <th>Address</th>
                         <th>Capacity</th>
                         <th>Ticket Value</th>
                         <th></th>
                         <th></th>
                    </thead>
                    <tbody>
                        <?php foreach($cinemaList as $cinema){ ?>
                        <tr>
                            <td><?php echo $cinema->getId() ?></td>
                            <td><?php echo $cinema->getName() ?></td>
                            <td><?php echo $cinema->getAddress() ?></td>
                            <td><?php echo $cinema->getCapacity() ?></td>
                            <td><?php echo $cinema->getTicketValue() ?></td>
                            <td>
                                <form action="<?php echo FRONT_ROOT ?>Cinema/RemoveCinema" method="POST">
                                    <input type="hidden" name="id" placeholder="ID" value="<?php echo $cinema->getId() ?>">
                                    <button type="submit" class="btn btn-sm btn-custom text-uppercase">Remove</button>
                                </form>
                            </td>
                            <td>
                                <form action="<?php echo FRONT_ROOT ?>Cinema/UpdateCinema" method="POST">
                                    <input type="hidden" name="id" placeholder="ID" value="<?php echo $cinema->getId() ?>">
                                    <button type="submit" class="btn btn-sm btn-custom text-uppercase">Modify</button>
                                </form>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
            </table>
        </div>
    </div>
</div>   