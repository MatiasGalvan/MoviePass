<?php
    require_once(VIEWS_PATH."nav-admin.php")
?>

<div class="container">
    <h3 class="mb-4 mt-4">Cinema List <a href="<?php echo FRONT_ROOT ?>Cinema/ShowAddCinemaView" style="text-decoration: none; color:#723dbe;"><i class="fas fa-plus"></i></a></h3>
    <div class="row justify-content-center">
        <div class="table-responsive">

            <div id="accordion">
                <?php foreach ($cinemaList as $cinema) { 
                    $name = $cinema->getName();
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
                        <div class="d-inline align-right">
                            <a class="btn btn-success" href="<?php echo FRONT_ROOT ?>Room/ShowAddRoomView/<?php echo $cinema->getId() ?>">Add Room <i class="fas fa-plus"></i></a>
                            <a class="btn btn-warning" href="<?php echo FRONT_ROOT ?>Cinema/UpdateCinema/<?php echo $cinema->getId() ?>">Update <i class="far fa-edit"></i></a>
                                <?php 
                                    if(empty($cinema->existRoom())){
                                        $content = "<a class=\"btn btn-danger\" href=\"" .  FRONT_ROOT . "Cinema/RemoveCinema/" . $cinema->getId() . "\">Remove <i class=\"far fa-trash-alt\"></i></a>";
                                        echo $content;
                                    }
                                ?>
                        </div>   

                        <table class="table table-striped table-dark table-bordered table-hover mt-3">
                            <thead>
                                <th>Room Name</th>
                                <th>Capacity</th>
                                <th>Actions</th>
                            </thead>
                            <tbody >
                                <?php 
                                if(!empty($cinema->getRooms())){ 
                                    foreach($cinema->getRooms() as $room){
                                ?>
                                <tr>     
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
                                <?php }}
                                    else{
                                        $content = "<tr><td colspan=\"5\" style=\"text-align: center;\"> There are no rooms </td> </tr>";
                                        echo $content;
                                    } ?>
                                
                            </tbody>
                        </table>


                        </div>
                    </div>
                </div>
                <?php } ?>
            </div> 

            <?php
                if(isset($message) && $message != ""){
                    echo "<p class=\"message mt-2\">" . $message . "</p>";
                }
            ?>

        </div>
    </div>
</div>   