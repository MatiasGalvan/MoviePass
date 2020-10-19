<?php

    $imgUrl = "https://image.tmdb.org/t/p/w300";
   
    
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
</style>

<div class="container">
    <h3 class="mb-2 mt-2">Now Playing Movies</h3>
    <div class="row justify-content-center">
          <?php  foreach($genreList as $genre)   {?>

            <input type="checkbox" name="genres[]" value="<?php $genre->getId()?>">
            <label class=""><?php echo $genre->getName() ?></label>
            <?php   }?>

          <input type='submit' class='buttons'>
        </div>
    <div class="row justify-content-center">
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