<?php
    require_once(VIEWS_PATH."nav-admin.php")
?>

<div class="container">
    <h3 class="mb-4 mt-4">Rooms List</h3>
    <div class="row justify-content-center">
        <div class="table-responsive">

            <div id="accordion">
                <?php foreach ($cinemaList as $cinema) { 
                    $name = $cinema->getName();
                    if(!empty($cinema->getRooms())){ 
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
                                <th>ID Room</th>
                                <th>ID Cinema</th>
                                <th>Room Name</th>
                                <th>Capacity</th>
                                <th>Actions</th>
                            </thead>
                            <tbody >
                                <?php 
                                    foreach($cinema->getRooms() as $room){
                                ?>
                                <tr>     
                                    <td class="align-middle"><?php echo $room->getIdRoom() ?></td>
                                    <td class="align-middle"><?php echo $room->getIdCinema() ?></td>
                                    <td class="align-middle"><?php echo $room->getRoomName() ?></td>
                                    <td class="align-middle"><?php echo $room->getCapacity() ?></td>
                                    <td style="text-align: center;">
                                        <form action="<?php echo FRONT_ROOT ?>Function/ShowAddFunctionView" method="POST">
                                            <input type="hidden" name="idRoom" placeholder="ID" value="<?php echo $room->getIdRoom() ?>">
                                            <input type="hidden" name="idCinema" placeholder="ID" value="<?php echo $room->getIdCinema() ?>">
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
                <?php } } ?>
            </div> 

        </div>
    </div>
</div>   