<?php

    namespace Utils;

    class Utils{

        public static function ValidateAdmin(){
            $flag = false;
            if(isset($_SESSION['role']) && $_SESSION['role'] == 'admin') $flag = true;
            return $flag;
        }
        
    }

?>