<?php
    require_once(VIEWS_PATH."nav-admin.php")
?>

<div class="container">
    <h3 class="mb-4 mt-4">Cinema List <a href="<?php echo FRONT_ROOT ?>Cinema/ShowAddCinemaView"><i class="fas fa-plus"></i> </a></h3>
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
                            <?php echo " - " ?> 
                            <?php echo $cinema->getAddress()?>    
                            <?php echo " - " ?> 
                            <?php echo "Capacity : ". $cinema->getCapacity()?>  
                            <?php echo " - " ?> 
                            <?php echo "Ticket Value : " . $cinema->getTicketValue()?>  
                        </div>

                    </a>
                    
                    <div id="<?php echo $name ?>" class="collapse" data-parent="#accordion">
                        <div class="card-body"> 
                        <div class="row">
                            <div class="col-sm">
                            <form action="<?php echo FRONT_ROOT ?>Cinema/UpdateCinema" method="POST">
                                <input type="hidden" name="id" placeholder="ID" value="<?php echo $cinema->getId() ?>">
                                <button type="submit" class="btn btn-warning"> Modify <i class="far fa-edit"></i>
                                </button>
                        </form> 
                            </div>
                            <div class="col-sm">
                            <form action="<?php echo FRONT_ROOT ?>Cinema/RemoveCinema" method="POST">
                             <input type="hidden" name="id" placeholder="ID" value="<?php echo $cinema->getId() ?>">
                                <button type="submit" class="btn btn-danger" <?php if(!empty($cinema->existRoom())) echo "disabled=\"true\""; ?>>
                                Remove <i class="far fa-trash-alt"></i>
                                </button>
                        </form>
                            </div>

                            <div class="col-sm">
                            <form action="<?php echo FRONT_ROOT ?>Room/ShowAddRoomView" method="POST">
                                <input type="hidden" name="id" placeholder="ID" value="<?php echo $cinema->getId() ?>">
                                <button type="submit" class="btn btn-success">Add Room <i class="fas fa-plus"></i>
                                </button>
                        </form>
                            </div>
                        </div>          

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

            <?php
                if(isset($message) && $message != ""){
                    $content = "<table class=\"table table-striped table-dark table-bordered table-hover\"><thead><th colspan=\"4\" style=\"text-align: center;\">" . $message . "</th></thead></table>";
                    echo $content;
                }
            ?>

        </div>
    </div>
</div>   