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
            <table class="table table-striped table-dark table-bordered table-hover">
                    <thead>
                         <th>ID</th>
                         <th>Name</th>
                         <th>Address</th>
                         <th>Capacity</th>
                         <th>Ticket Value</th>
                         <th style="text-align: center; " colspan="3">Actions</th>
                    </thead>
                    <tbody >
                        <?php foreach($cinemaList as $cinema){ ?>
                        <tr>
                            <td class="align-middle"><?php echo $cinema->getId() ?></td>
                            <td class="align-middle"><?php echo $cinema->getName() ?></td>
                            <td class="align-middle"><?php echo $cinema->getAddress() ?></td>
                            <td class="align-middle"><?php echo $cinema->getCapacity() ?></td>
                            <td class="align-middle"><?php echo $cinema->getTicketValue() ?></td>
                            <td style="text-align: center; ">
                                <form action="<?php echo FRONT_ROOT ?>Cinema/UpdateCinema" method="POST">
                                    <input type="hidden" name="id" placeholder="ID" value="<?php echo $cinema->getId() ?>">
                                    <button type="submit" class="btn btn-warning">
                                        Modify <i class="far fa-edit"></i>
                                    </button>
                                </form>
                            </td>
                            <td style="text-align: center;">
                                <form action="<?php echo FRONT_ROOT ?>Cinema/RemoveCinema" method="POST">
                                    <input type="hidden" name="id" placeholder="ID" value="<?php echo $cinema->getId() ?>">
                                    <button type="submit" class="btn btn-danger">
                                        Remove <i class="far fa-trash-alt"></i>
                                    </button>
                                </form>
                            </td>
                            <td style="text-align: center;">
                                <form action="<?php echo FRONT_ROOT ?>Function/ShowAddFunctionView" method="POST">
                                    <input type="hidden" name="id" placeholder="ID" value="<?php echo $cinema->getId() ?>">
                                    <button type="submit" class="btn btn-success">
                                        Add Function <i class="fas fa-plus"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
            </table>
        </div>
    </div>
</div>   