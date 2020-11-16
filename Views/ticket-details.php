<div class="container">
    <div class="card">
        <h4 class="card-header text-uppercase text-center"><?php echo $data['movie'] ?></h4>
        <div class="card-body">
            <h5 class="card-title"><?php echo $data['cinemaName'] ?> - <?php echo $cinema->getAddress() ?></h5>
            <hr width = 100%>

            <table class="table table-striped table-bordered">
                <tr>
                    <td>Room</td>
                    <td>Date</td>
                    <td>Time</td>
                    <td>Quantity</td>
                </tr>
                <tr>
                    <td><?php echo $data['room']; ?></td>
                    <td><?php echo $data['date']; ?></td>
                    <td><?php echo $data['time']; ?></td>
                    <td><?php echo $data['quantity']; ?></td>
                </tr>
            </table>

            <p class="card-text p-2 bg-secondary text-white text-right">Price: <?php echo $data['total']; ?></p>
        </div>
    </div>
</div>