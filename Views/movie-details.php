<?php
    $url;

    if(isset($_SESSION['email']) && !empty($_SESSION['email'])){
        if(isset($_SESSION['role']) && $_SESSION['role'] == 'admin'){
            $url = "nav-admin.php";
        }
        else{
            $url = "nav-client.php";
        }
    } 
    else{
        $url = "nav-unknown.php";
    }

    require_once(VIEWS_PATH.$url);
?>

<div class="container">

    <?php if(!isset($_SESSION['role']) || $_SESSION['role'] != 'admin'){ ?>
    <div class="mt-3">
        <a href="<?php echo FRONT_ROOT ?>Movie/ShowMovies" class="custom-anchor mt-3"><i class="far fa-arrow-alt-circle-left"></i> Go Back</a>
    </div>
    <?php } ?>

    <div class="mt-3">
    <?php 
        if(isset($_SESSION['role']) && $_SESSION['role'] == 'admin'){
            $content = "<a href=\"" . FRONT_ROOT . "/Movie/ShowUpdateMovies\" class=\"custom-anchor mt-3\"><i class=\"far fa-arrow-alt-circle-left\"></i> Go Back to admin view</a>";
            echo $content;
        }
        if(isset($message)){
            echo "<p class=\"message mt-2\">" . $message . "</p>";
        }
    ?>
    </div>

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

            <p>Release date: <?php echo $movie->getReleaseDate(); ?></p>

            <p>Original language: <?php echo $movie->getOriginalLanguage(); ?></p>

            <p>Duration: <?php echo $movie->getRuntime(); ?> minutes</p>

            <h5 class="mt-3">Overview</h5>
            <p>
                <?php echo $movie->getOverview(); ?>
            </p>

            
            <h5 class="mt-3 mb-3">Cinemas</h5>

            <div class="row justify-content-center">
                <div class="table-responsive">
                    <div id="accordion">
                        <?php 
                        $i = 0;
                        
                        foreach ($cinemaList as $cinema) { 
                            $i++;
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
                                            <th>Action</th>
                                        </thead>
                                        <tbody >
                                            <?php 
                                                foreach($cinema->getRooms() as $room){
                                                    foreach($room->getFunctions() as $function) {
                                                        if($function->getTickets() > 0){
                                            ?>
                                            <tr>
                                                <td class="align-middle"><?php echo $function->getDate() ?></td>
                                                <td class="align-middle"><?php echo $function->getStart() ?></td>
                                                <td>
                                                    <?php
                                                        $url;
                                                        if(isset(($_SESSION['email'])) && !empty($_SESSION['email'] && $_SESSION["role"] == "client")){
                                                            $url = 
                                                            "
                                                            <form action=\"" . FRONT_ROOT . "Ticket/ShowTicketPurchaseView\" method=\"POST\">
                                                                <input type=\"hidden\" name=\"idCinema\" value=\"" . $cinema->getId() . "\">
                                                                <input type=\"hidden\" name=\"idFunction\" value=\"" . $function->getIdFunction() . "\">
                                                                
                                                                <button type=\"submit\" class=\"btn btn-success\">Buy Ticket <i class=\"fas fa-dollar-sign\" ></i></button>
                                                            </form>
                                                            ";
                                                        }
                                                        else{
                                                            $url = 
                                                            "
                                                            <form action=\"" . FRONT_ROOT . "Movie/ShowMovieDetails\" method=\"POST\">
                                                                <input type=\"hidden\" name=\"idMovie\" value=\"" . $movie->getId() . "\">
                                                                <input type=\"hidden\" name=\"message\" value=\"You need to login to complete this action\">

                                                                <button type=\"submit\" class=\"btn btn-success\" disabled>Buy Ticket <i class=\"fas fa-dollar-sign\" ></i></button>
                                                            </form>
                                                            ";    
                                                        }

                                                        echo $url;

                                                    ?> 
                                                </td>
                                            </tr>
                                            <?php 
                                                }}} 
                                            ?>
                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </div>
                        <?php } ?>
                    </div> 
                </div>
            </div>

            <?php
                if($i == 0){
                    echo "<p>No functions available</p>";
                }
            ?>

        </div>

    </div>

</div>