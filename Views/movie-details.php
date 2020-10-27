<?php
    require_once(VIEWS_PATH."nav-client.php")
?>

<div class="container">
    <div class="row mt-3">
        <div class="col-4">
            <div class="card">
                <img src="<?php echo IMG_URL_300 . $movie->getPosterPath() ?>" class="card-img-top" alt="Image not found">
            </div>
        </div>

        <div class="col-8">
            <h1 class="font-weight-light text-uppercase mb-3"><?php echo $movie->getTitle(); ?></h1>

            <p>
                <?php
                    $i = 0;
                    foreach($genreList as $genre){
                        if(in_array($genre->getId(), $movie->getGenres())){
                            if($i == 0) echo $genre->getName();
                            else echo ", " . $genre->getName();
                            $i++;
                        }
                    }
                ?>
            </p>

            <span>Release date: <?php echo $movie->getReleaseDate(); ?></span>

            <h5 class="mt-3">Overview</h5>
            <p>
                <?php echo $movie->getOverview(); ?>
            </p>
        </div>

    </div>

</div>