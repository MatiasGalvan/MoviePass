<?php
    require_once(VIEWS_PATH."nav-admin.php")
?>

<div class="container">
    <h3 class="mb-4 mt-4">Cinemas List</h3>
    <div class="row justify-content-center">
        <div class="table-responsive">
            <table class="table table-striped table-dark table-bordered table-hover">
                    <thead>
                         <th>Date</th>
                         <th>Start</th>
                         <th>ID Movie</th>
                         <th>ID Cinema</th>
                         <th style="text-align: center; " colspan="3">Actions</th>
                    </thead>
                    <tbody >
                        <?php foreach($functionList as $function){ ?>
                        <tr>
                            <td class="align-middle"><?php echo $function->getDate() ?></td>
                            <td class="align-middle"><?php echo $function->getStart() ?></td>
                            <td class="align-middle"><?php echo $function->getMovieId() ?></td>
                            <td class="align-middle"><?php echo $function->getIdCinema() ?></td>

                            <td style="text-align: center; ">
                                <form action="<?php echo FRONT_ROOT ?>Cinema/UpdateCinema" method="POST">
                                    <input type="hidden" name="id" placeholder="ID" value="<?php echo $function->getIdCinema() ?>">
                                    <button type="submit" class="btn btn-warning">
                                        Modify <i class="far fa-edit"></i>
                                    </button>
                                </form>
                            </td>

                            <td style="text-align: center;">
                                <form action="<?php echo FRONT_ROOT ?>Cinema/RemoveCinema" method="POST">
                                    <input type="hidden" name="id" placeholder="ID" value="<?php echo $function->getIdCinema() ?>">
                                    <button type="submit" class="btn btn-danger">
                                        Remove <i class="far fa-trash-alt"></i>
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