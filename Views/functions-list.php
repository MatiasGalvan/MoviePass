<?php
    require_once(VIEWS_PATH."nav-admin.php")
?>

<div class="container">
    <h3 class="mb-4 mt-4">Functions List</h3>
    <div class="row justify-content-center">
        <div class="table-responsive">

            <div id="accordion">
                <?php foreach ($cinemaList as $cinema) { 
                    $name = $cinema->getName();
                    if(!empty($cinema->existFunction())){
                ?>
                <div class="card">
                    <a class="card-link custom-anchor" data-toggle="collapse" href="#<?php echo $name ?>">        
                        <div class="card-header flex">
                            <?php echo $name ?>  
                        </div>
                    </a>
                    
                    <div id="<?php echo $name ?>" class="collapse" data-parent="#accordion">
                        <div class="card-body">
                            
                        <table class="table table-striped table-dark table-bordered table-hover">
                            <thead>
                                <th>Date</th>
                                <th>Start</th>
                                <th>ID Movie</th>
                                <th>Actions</th>
                            </thead>
                            <tbody >
                                <?php 
                                    foreach($cinema->getRooms() as $room){ 
                                        foreach($room->getFunctions() as $function){ 
                                ?>
                                <tr>         
                                    <td class="align-middle"><?php echo $function->getDate() ?></td>
                                    <td class="align-middle"><?php echo $function->getStart() ?></td>
                                    <td class="align-middle"><?php echo $function->getMovieId() ?></td>
                                    <td style="text-align: center;">
                                        <form action="<?php echo FRONT_ROOT ?>Movie/ShowMovieDetails" method="POST">
                                            <input type="hidden" name="idMovie" placeholder="ID" value="<?php echo $function->getMovieId() ?>">
                                            <button type="submit" class="btn btn-success">
                                                View <i class="fas fa-search"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>                               
                                <?php }} ?>
                            </tbody>
                        </table>

                        </div>
                    </div>
                </div>
                <?php } } ?>
            </div> 

            <?php
                if(isset($message) && $message != ""){
                    $content = "<table class=\"table table-striped table-dark table-bordered table-hover\"><thead><th colspan=\"4\" style=\"text-align: center;\">" . $message . "</th></thead></table>";
                    echo $content;
                }
            ?>

        </div>
    </div>
</div>   