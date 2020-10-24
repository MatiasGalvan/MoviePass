<?php

    namespace Controllers;

    class FunctionController{

        public function __construct(){

        }

        public function ShowAddFunctionsView(){
            require_once(VIEWS_PATH."add-functions.php");
        }
        
        public function ShowFunctions(){
            require_once(VIEWS_PATH."functions-list.php");
        }

    }

?>