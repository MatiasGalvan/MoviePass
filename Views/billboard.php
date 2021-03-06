<?php
    $url;

    (!empty($_SESSION['email'])) ? $url = "nav-client.php" : $url = "nav-unknown.php";

    require_once(VIEWS_PATH.$url);
?>

<div class="p-5">
    <h3 class="mb-4">Now Playing Movies</h3>
    
    <div class="row shadow p-3">

        <div class="col-2">
            <h4 class="mb-3">Filter Movies</h4>
            <?php
                if(isset($message)) echo "<p class=\"message mt-2\">" . $message . "</p>";    
            ?>
            <form action="<?php echo FRONT_ROOT ?>Movie/FilterMovies" METHOD="Post">
                <h6 class="mt-3 mb-3">Date</h6>
                <input type="date" name="date" id="date" class="form-control form-control-sm">
                <h6 class="mt-3 mb-3">Genres</h6>
                <?php  foreach($genreList as $genre){
                    $id = $genre->getId();
                ?>
                    <div class="custom-control-inline custom-checkbox">                        
                        <input type="checkbox" name="genres[]" class="custom-control-input" id="<?php echo $id; ?>" value="<?php echo $id; ?>">
                        <label class="custom-control-label" for="<?php echo $id; ?>">
                            <?php echo $genre->getName() ?>
                        </label>
                    </div>
                <?php   }?>
                <button type="submit" class="btn mt-3 btn-sm btn-custom btn-block text-uppercase">Filter <i class="fas fa-filter"></i></button>
            </form>
        </div>

        <div class="col-10">

            <div class="d-flex flex-row bd-highlight mb-3">   
                <div class="row justify-content-around flex-grow-1">
                    <?php foreach ($movieList as $movie) { ?>
                        <a href="<?php echo FRONT_ROOT ?>Movie/ShowMovieDetails?idMovie=<?php echo $movie->getId(); ?>">
                            <div class="card" style="width: 220px;">
                                <img src="<?php echo IMG_URL_300 . $movie->getPosterPath() ?>" class="card-img-top zoom" alt="Image not found">
                            </div>
                        </a>
                    <?php } ?>  
                </div> 
            </div>

        </div>

    </div>
</div>