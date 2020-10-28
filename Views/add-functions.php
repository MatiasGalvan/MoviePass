<?php
    require_once(VIEWS_PATH."nav-admin.php")
?>
<main>
    <div class="mt-5">
        <form action="<?php echo FRONT_ROOT ?>Function/AddFunction" method="POST" class="login-form text-center">
            <h1 class="mb-5 font-weight-light text-uppercase">ADD FUNCTION</h1>
            <div class="form-group">
                <input type="date" name="date" class="form-control form-control-lg" placeholder="Date" 
                value="<?php if(isset($data['date'])) echo $data['date']; ?>" required>
            </div>
            <div class="form-group">
                <input type="time" name="start" class="form-control form-control-lg" placeholder="Start" 
                value="<?php if(isset($data['start'])) echo $data['start']; ?>" required>
            </div>       
            <div>
                <select name="idMovie" class="browser-default custom-select">
                <?php foreach($movieList as $movie){ ?>
                    <option value="<?php echo $movie->getId()?>"><?php echo $movie->getTitle() ?></option>
                    <?php } ?>
                </select> 
            </div>
            <input type="hidden" name="id" placeholder="ID" value="<?php echo $idCinema ?>">
            <button type="submit" class="btn mt-5 btn-lg btn-custom btn-block text-uppercase">Add Function</button>
        </form>

    </div>
</main>
