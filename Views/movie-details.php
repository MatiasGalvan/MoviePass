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

            
            <h5 class="mt-3 mb-3">Functions</h5>
            <div class="justify-content-center">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover">
                            <thead>
                                <th>Date</th>
                                <th>Start time</th>
                                <th>Cinema</th>
                            </thead>
                            <tbody >
                                <?php foreach($functionList as $function){ ?>
                                <tr>
                                    <td class="align-middle"><?php echo $function->getDate() ?></td>
                                    <td class="align-middle"><?php echo $function->getStart() ?></td>
                                    <td class="align-middle">
                                        <?php 
                                            $i = 0;
                                            $flag = false;
                                            $response = "";
                                            while($flag == false && $i < count($cinemaList)){
                                                if($function->getIdCinema() == $cinemaList[$i]->getId()){
                                                    $flag = true;
                                                    $response =  $cinemaList[$i]->getName();
                                                }
                                                $i++;
                                            }
                                            echo $response;
                                        ?>
                                    </td>
                                </tr>
                                <?php } 

                                    if(empty($functionList)){
                                        $alt = 
                                        "
                                            <tr>
                                                <td colspan=\"3\" style=\"text-align: center;\">No functions available.</td>
                                            </tr>
                                        ";
                                        echo $alt;
                                    }
                                ?>
                            </tbody>
                    </table>
                </div>
            </div>


        </div>

    </div>

</div>