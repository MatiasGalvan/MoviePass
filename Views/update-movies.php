<?php
    require_once(VIEWS_PATH."nav-admin.php")
?>

<div class="container">
    <form action="<?php echo FRONT_ROOT ?>Movie/ReloadMovies" method="post">
        <button id="submitBtn" type="submit" class="btn mt-4 mb-2 btn-lg btn-custom btn-block text-uppercase">Update <i class="fas fa-sync-alt"></i></button>
    </form>
    <?php
        if(isset($message)){
            echo "<p class=\"message\">" . $message . "</p>";
        }
    ?>
    <h3 class="mb-4 mt-4">Movie List</h3>

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