<?php

    namespace DAO;

    use Models\Cinema as Cinema;

    interface ICinemaDAO{

        function Add(Cinema $cinema);
        #function Remove($email);
        function GetAll();

    }
    
?>