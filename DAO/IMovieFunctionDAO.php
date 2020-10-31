<?php

    namespace DAO;

    use Models\MovieFunction as MovieFunction;

    interface IMovieFunctionDAO{

        function Add(MovieFunction $MovieFunction);
        function GetAll();

    }
    
?>