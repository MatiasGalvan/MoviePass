<?php
    require_once(VIEWS_PATH."nav-admin.php")
?>

<div class="container">
    <h3 class="mb-4 mt-4">Functions List</h3>
    <div class="row justify-content-center">
        <div class="table-responsive">
            <table class="table table-striped table-dark table-bordered table-hover">
                    <thead>
                         <th>Date</th>
                         <th>Start</th>
                         <th>ID Movie</th>
                         <th>ID Cinema</th>
                         <th>Actions</th>
                    </thead>
                    <tbody >
                        <?php foreach($functionList as $function){ ?>
                        <tr>         
                            <td class="align-middle"><?php echo $function->getDate() ?></td>
                            <td class="align-middle"><?php echo $function->getStart() ?></td>
                            <td class="align-middle"><?php echo $function->getMovieId() ?></td>
                            <td class="align-middle"><?php echo $function->getIdCinema() ?></td>
                            <td style="text-align: center;">
                                <form action="<?php echo FRONT_ROOT ?>Movie/ShowMovieDetails" method="POST">
                                    <input type="hidden" name="idMovie" placeholder="ID" value="<?php echo $function->getMovieId() ?>">
                                    <button type="submit" class="btn btn-success">
                                        View <i class="fas fa-search"></i>
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