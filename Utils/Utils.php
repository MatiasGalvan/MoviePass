<?php

    namespace Utils;

    class Utils{

        public static function ValidateAdmin(){
            $flag = false;
            if(isset($_SESSION['role']) && $_SESSION['role'] == 'admin') $flag = true;
            return $flag;
        }

        public static function checkEmail($value){
            $response = false;
            if(filter_var($value, FILTER_VALIDATE_EMAIL)){
                $response = true;
            }
            return $response;
        }
    
        public static function checkString($value){
            $regularString = "/(^(?=.{3,20}$)[A-ZÁÉÍÓÚ]{1}([a-zñáéíóú]+){2,})$/";
            $response = false;
            if (preg_match($regularString, $value)){
                $response = true;
            }
            return $response;
        }
    
        public static function checkDNI($value){
            $regularDNI = "/^[0-9]{8}$/";
            $response = false;
            if (preg_match($regularDNI, $value)){
                $response = true;
            }
            return $response; 
        }
    
        public static function checkPassword($value){
            /*
            Minimo 8 caracteres
            Maximo 15
            Al menos una letra mayúscula
            Al menos una letra minucula
            Al menos un dígito
            No espacios en blanco
            */
            $regularPass = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)([A-Za-z\d]|[^ ]){8,15}$/";
            $response = false;
            if (preg_match($regularPass, $value)){
                $response = true;
            }
            return $response; 
        }

        public static function checkDate($date){
            $response = true;
            $time = time();
            $currentDate = date("Y-m-d", $time);
            
            if($date < $currentDate) $response = false;

            return $response;
        }

        public static function checkTime($time){
            $response = true;
            $currentTime = date("H:i", time());

            if($time < $currentTime) $response = false;

            return $response;
        }

        public static function checkNumber($value){
            $regularNumber = "/(^[0-9]{1,4}$)/";
            $response = false;
            if (preg_match($regularNumber, $value) && $value > 0){
                $response = true;
            }
            return $response; 
        }

        public static function checkAddress($value){
            $regularString = "/(^(?=.{3,20}$)[A-ZÁÉÍÓÚ]{1}([a-zñáéíóú]+){2,} \d{1,5})$/";
            
            $response = false;
            if (preg_match($regularString, $value)){
                $response = true;
            }
            return $response;
        }
        
        public static function AddMinutes($time, $minutes){ 
            $secondsTime = strtotime($time);
            $seconds = $minutes * 60;
            $newTime = date("H:i:s", $secondsTime + $seconds);
            return $newTime;
        }

    }

?>