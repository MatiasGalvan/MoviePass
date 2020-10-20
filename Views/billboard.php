<?php
    $imgUrl = "https://image.tmdb.org/t/p/w300";
    require_once(VIEWS_PATH."nav-client.php")
?>

<style>
    .card-body{
        padding: 0.75rem 1rem;
    }
    .card{
        margin: 5px 10px;
    }
    .card-title{
        color: black;
    }
    .custom-control-inline {
        margin-left: 1em;
    }
    .btn-custom {
        min-height: 20px;
    }
</style>

<div class="p-5">
    <h3 class="mb-4">Now Playing Movies</h3>
    
    <div class="row">

        <div class="col-2">
            <h5 class="mb-3">Genres List</h5>
                <form action="<?php echo FRONT_ROOT ?>Movie/FilterMovies" METHOD="Post">
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
                    <button type="submit" class="btn mt-3 btn-sm btn-custom btn-block text-uppercase">Filter</button>
                </form>
                <?php
                    if(isset($message)) echo "<p class=\"message mt-2\">" . $message . "</p>";    
                ?>
        </div>

        <div class="col-10">

            <div class="d-flex flex-row bd-highlight mb-3">   
                <div class="row justify-content-around flex-grow-1">
                    <?php foreach ($movieList as $movie) { ?>
                        <div class="card" style="width: 220px;">
                            <img src="<?php echo $imgUrl . $movie->getPosterPath() ?>" class="card-img-top">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $movie->getTitle() ?></h5>
                                <p class="card-subtitle mb-2 text-muted"><?php echo $movie->getReleaseDate() ?></p>
                            </div>
                        </div>
                    <?php } ?>  
                </div> 
            </div>

        </div>

    </div>
</div>