<?php
    require_once(VIEWS_PATH."nav-admin.php")
?>
<main>
    <div class="mt-5">
        <form action="<?php echo FRONT_ROOT ?>Statistics/FilterStats" method="POST" class="login-form text-center">
            <h1 class="mb-5 font-weight-light text-uppercase">STATISTICS</h1>

            <div class="form-group">
                <select name="idCinema" class="browser-default custom-select">
                <option value="" disabled selected>Choose Cinema</option>
                <?php foreach($cinemaList as $cinema){ ?>
                    <option value="<?php echo $cinema->getId()?>"><?php echo $cinema->getName() ?></option>
                    <?php } ?>
                </select> 
            </div>
            <div class="form-group">
                <select name="idMovie" class="browser-default custom-select">
                <option value="" disabled selected>Choose Movie</option>
                <?php foreach($movieList as $movie){ ?>
                    <option value="<?php echo $movie->getId()?>"><?php echo $movie->getTitle() ?></option>
                    <?php } ?>
                </select> 
            </div>
            <div class="form-group">
                <input type="date" name="date" class="form-control form-control-lg" placeholder="Date" 
                value="<?php if(isset($data['date'])) echo $data['date']; ?>" required>
            </div>
            <div class="form-group">
                <input type="date" name="date" class="form-control form-control-lg" placeholder="Date" 
                value="<?php if(isset($data['date'])) echo $data['date']; ?>" required>
            </div>


            <button type="submit" class="btn mt-5 btn-lg btn-custom btn-block text-uppercase">Show  Statistics</button>
            <?php
            if(isset($errors)){
                echo "<ul class = \"mt-3\">";
                foreach ($errors as $error){
                    echo "<li class=\"message\">" . $error . "</li>";
                }
                echo "</ul>";
            }
            if(isset($message)){
                echo "<p class=\"message\">" . $message . "</p>";
            }
            ?>       
        </form>

    </div>
</main>
