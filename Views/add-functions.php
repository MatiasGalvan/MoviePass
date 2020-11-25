<div style="height: 100vh;">

    <?php
        require_once(VIEWS_PATH."nav-admin.php")
    ?>

    <div class="row d-flex justify-content-center align-items-center" style="margin: 0; height:91%;">

        <div class="col-7">
            <div class="d-flex justify-content-center align-items-center" style="height: 91%;">
                <form action="<?php echo FRONT_ROOT ?>Function/AddFunction" method="POST" class="login-form text-center">
                    <h1 class="mb-5 font-weight-light text-uppercase">ADD FUNCTION</h1>
                    <div class="form-group">
                        <input type="date" name="date" class="form-control form-control-lg" placeholder="Date" 
                        value="<?php if(isset($data['date'])) echo $data['date']; ?>" required>
                    </div>
                    <div class="form-group">
                        <input type="time" name="start" class="form-control form-control-lg" placeholder="Start" 
                        value="<?php if(isset($data['start'])) echo $data['start']; ?>" required>
                    </div>       
                    <div>
                        <select name="idMovie" class="browser-default custom-select">
                        <?php foreach($movieList as $movie){ ?>
                            <option value="<?php echo $movie->getId()?>"><?php echo $movie->getTitle() ?></option>
                            <?php } ?>
                        </select> 
                    </div>
                    <input type="hidden" name="idRoom" placeholder="ID" value="<?php echo $idRoom ?>">
                    <input type="hidden" name="idCinema" placeholder="ID" value="<?php echo $idCinema ?>">
                    <button type="submit" class="btn mt-5 btn-lg btn-custom btn-block text-uppercase">Add Function</button>
                    <?php
                    if(isset($errors)){
                        echo "<ul class = \"mt-3\">";
                        foreach ($errors as $error){
                            echo "<li class=\"message\">" . $error . "</li>";
                        }
                        echo "</ul>";
                    }
                    if(isset($message)){
                        echo "<p class=\"message\">" . $message . "</p>";
                    }
                    ?>       
                </form>

            </div>
        </div>

        <div class="col-5" style="margin-left: -100px;">
            <h4 class="mb-3 font-weight-light"><?php echo $cinema->getName() . " - " . $room->getRoomName() ?></h4>
            <div class="d-flex justify-content-center align-items-center">
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                        <th>Date</th>
                        <th>Start</th> 
                        <th>Movie Name</th>                                        
                    </thead>
                    <tbody>
                        <?php foreach($room->getFunctions() as $function){ ?>
                            <tr>
                                <td class="align-middle"><?php echo $this->utils->FormatDate($function->getDate()); ?></td>
                                <td class="align-middle"><?php echo $function->getStart() ?></td>
                                <td class="align-middle">
                                    <?php
                                        $i = 0;
                                        $flag = false;
                                        $movie = "";
                                        while($i < count($movieList) && $flag == false){
                                            if($movieList[$i]->getId() == $function->getMovieId()){
                                                $movie = $movieList[$i]->getTitle();
                                                $flag = true;
                                            }
                                            $i++;
                                        }
                                        echo $movie;
                                    ?>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
