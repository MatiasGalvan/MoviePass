<?php
    require_once(VIEWS_PATH."nav-admin.php")
?>
<main>
    <div class="mt-5">
        <form action="<?php echo FRONT_ROOT ?>Room/AddRoom" method="POST" class="login-form text-center">
            <h1 class="mb-5 font-weight-light text-uppercase">ADD ROOM</h1>
            <input type="hidden" name="id" placeholder="ID" value="<?php echo $idCinema ?>">
            <div class="form-group">
                <input type="text" name="roomName" class="form-control form-control-lg" placeholder="Room Name" 
                value="<?php if(isset($data['roomName'])) echo $data['roomName']; ?>" required>
            </div>
            <div class="form-group">
                <input type="number" name="capacity" class="form-control form-control-lg" placeholder="Capacity" 
                value="<?php if(isset($data['capacity'])) echo $data['capacity']; ?>" required>
            </div>       
            <button type="submit" class="btn mt-5 btn-lg btn-custom btn-block text-uppercase">Add Room</button>     
        </form>

    </div>
</main>