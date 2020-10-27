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
    <div class="row justify-content-center">
        <div class="table-responsive">
            <table class="table table-striped table-dark table-bordered">
                    <thead>
                         <th>ID</th>
                         <th>Title</th>
                         <th>Release Date</th>
                         <th>Poster Path</th>
                         <th>Overview</th>
                         <th>Language</th>
                    </thead>
                    <tbody>
                        <?php foreach($movieList as $movie){ ?>
                        <tr>
                            <td><?php echo $movie->getId() ?></td>
                            <td><?php echo $movie->getTitle() ?></td>
                            <td><?php echo $movie->getReleaseDate() ?></td>
                            <td><?php echo $movie->getPosterPath() ?></td>
                            <td><?php echo $movie->getOverview() ?></td>
                            <td><?php echo $movie->getOriginalLanguage() ?></td>
                        </tr>
                        <?php } ?>
                    </tbody>
            </table>
        </div>
    </div>
</div>   