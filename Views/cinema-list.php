<div class="container">
    <h3 class="mb-2 mt-2">Cinemas List</h3>
    <div class="row justify-content-center">
        <div class="table-responsive">
            <table class="table table-striped table-dark table-bordered">
                    <thead>
                         <th>ID</th>
                         <th>Name</th>
                         <th>Address</th>
                         <th>Capacity</th>
                         <th>Ticket Value</th>
                    </thead>
                    <tbody>
                    <?php
                        foreach($cinemaList as $cinema)
                        {
                             ?>
                             <tr>
                                   <td><?php echo $cinema->getId() ?></td>
                                   <td><?php echo $cinema->getName() ?></td>
                                   <td><?php echo $cinema->getAddress() ?></td>
                                   <td><?php echo $cinema->getCapacity() ?></td>
                                   <td><?php echo $cinema->getTicketValue() ?></td>
                             </tr>
                              <?php 
                        }
                    ?>
                    </tbody>
            </table>
        </div>
    </div>
</div>   