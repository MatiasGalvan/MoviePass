<?php

    $imgUrl = "https://image.tmdb.org/t/p/w300";

    foreach ($movieList as $movie) {
        echo "<h4> Titulo: " . $movie->getTitle() . "</h4>";
        echo "<img src=" . $imgUrl . $movie->getPosterPath() . ">";
    }

?>