<?php
    require_once(VIEWS_PATH."nav-client.php")
?>

<div class="container">

    <div class="mt-3">
        <a href="<?php echo FRONT_ROOT ?>Movie/ShowMovies" class="custom-anchor mt-3"><i class="far fa-arrow-alt-circle-left"></i> Go Back</a>
    </div>

    <?php 
        if($_SESSION['role'] == 'admin'){
            $content = "<a href=\"" . FRONT_ROOT . "Function/ShowFunctions\" class=\"custom-anchor mt-3\"><i class=\"far fa-arrow-alt-circle-left\"></i> Go Back to admin view</a>";
            echo $content;
        }
    ?>

    <div class="row">
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

            
            <h5 class="mt-3 mb-3">Cinemas</h5>

            <div class="row justify-content-center">
                <div class="table-responsive">
                    <div id="accordion">
                        <?php foreach ($cinemaList as $cinema) { 
                            $name = $cinema->getName();
                        ?>

                        <div class="card">
                            <a class="card-link custom-anchor" data-toggle="collapse" href="#<?php echo $name ?>">        
                                <div class="card-header flex">
                                    <?php echo $name . " - " . $cinema->getAddress(); ?>
                                </div>
                            </a>
                            
                            <div id="<?php echo $name ?>" class="collapse" data-parent="#accordion">
                                <div class="card-body">
                 
                                    <table class="table table-striped table-bordered table-hover">
                                        <thead>
                                            <th>Date</th>
                                            <th>Start time</th>
                                        </thead>
                                        <tbody >
                                            <?php foreach($cinema->getBillboard() as $function){ ?>
                                            <tr>
                                                <td class="align-middle"><?php echo $function->getDate() ?></td>
                                                <td class="align-middle"><?php echo $function->getStart() ?></td>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </div>
                        <?php } ?>
                    </div> 
                </div>
            </div>

        </div>

    </div>

</div>