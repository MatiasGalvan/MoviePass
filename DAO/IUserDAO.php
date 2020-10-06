<?php

    namespace DAO;

    use Models\User as User;

    interface IUserDAO{

        function Add(User $user);
        function Remove($email);
        function GetAll();

    }
    
?>