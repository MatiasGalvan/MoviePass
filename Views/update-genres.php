<?php
    require_once(VIEWS_PATH."nav-admin.php")
?>

<div class="container">
    <form action="<?php echo FRONT_ROOT ?>Movie/SaveGenres" method="post">
        <button id="submitBtn" type="submit" class="btn mt-4 mb-2 btn-lg btn-custom btn-block text-uppercase">Update</button>
    </form>
    <?php
        if(isset($message)){
            echo "<p class=\"message\">" . $message . "</p>";
        }
    ?>
    <h3 class="mb-4 mt-4">Genre List</h3>
    <div class="row justify-content-center">
        <div class="table-responsive">
            <table class="table table-striped table-dark table-bordered">
                    <thead>
                         <th>ID</th>
                         <th>Name</th>
                    </thead>
                    <tbody>
                        <?php foreach($genreList as $genre){ ?>
                        <tr>
                            <td><?php echo $genre->getId() ?></td>
                            <td><?php echo $genre->getName() ?></td>
                        </tr>
                        <?php } ?>
                    </tbody>
            </table>
        </div>
    </div>
</div>   