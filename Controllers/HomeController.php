<?php

    namespace Controllers;

    use Models\User as User;
    use Models\UserProfile as UserProfile;
    use Models\Role as Role;
    use DAO\UserDAO as UserDAO;
    use Controllers\MovieController as MovieController;

    class HomeController{

        private $userDAO;

        public function __construct(){
            $this->userDAO = new UserDAO();
        }

        public function ShowLoginView($message = ""){
            require_once(VIEWS_PATH."home.php");
        }
        
        public function ShowRegistrationView($errors = array()){
            require_once(VIEWS_PATH."registration.php");
        }

        public function Login($email, $password){
            $userList = $this->userDAO->GetAll();
            $flag = false;

            foreach($userList as $user){
                if($user->getEmail() == $email){
                    if($user->getPassword() == $password){
                        #$_SESSION['user'] = $user;
                        $_SESSION["email"] = $email;
                        $flag = true;
                    }
                }
            }

            if($flag){
                $movies = new MovieController();
                $movies->ShowMovies();
            }
            else{
                $this->ShowLoginView("The email or password is incorrect");
            }
        }

        public function Register($name, $lastname, $dni, $email, $password){
            $errors = $this->checkData($name, $lastname, $dni, $email, $password);
            if(count($errors) == 0){
                if(!($this->userDAO->Exist($email))){
                    $user = new User();
                    $profile = new UserProfile();
                    $role = new Role();
                    $role->setDescription('client');

                    $profile->setName($name);
                    $profile->setLastname($lastname);
                    $profile->setDni($dni);

                    $user->setEmail($email);
                    $user->setPassword($password);
                    $user->setProfile($profile);
                    $user->setRole($role);

                    $this->userDAO->Add($user);

                    $this->ShowLoginView("Your account has been created successfully");
                }
                else{
                    array_push($errors, "The email has already been taken");
                    $this->ShowRegistrationView($errors);
                }
            }
            else{
                $this->ShowRegistrationView($errors);
            }
        }

        public function Logout(){
            session_destroy();
            $this->ShowLoginView();
        }

        public function checkData($name, $lastname, $dni, $email, $password){
            $errors = array();
            if (!$this->checkString($name)) array_push($errors, "Invalid format. Name must be between 3 and 20 characters. And start with uppercase.");
            if (!$this->checkString($lastname)) array_push($errors, "Invalid format. Lastname must be between 3 and 20 characters. And start with uppercase.");
            if (!$this->checkDNI($dni)) array_push($errors, "Invalid format. DNI must have 8 numbers without spaces, periods or characters.");
            if (!$this->checkEmail($email)) array_push($errors, "Invalid format. Example: 'example@domain.com'");
            if (!$this->checkPassword($password)) array_push($errors, "Password must be at least 8 characters long with 1 uppercase 1 lowercase and 1 numeric character");

            return $errors;
        }

        function checkEmail($value){
            $response = false;
            if(filter_var($value, FILTER_VALIDATE_EMAIL)){
                $response = true;
            }
            return $response;
        }
    
        function checkString($value){
            $regularString = "/(^(?=.{3,20}$)[A-ZÁÉÍÓÚ]{1}([a-zñáéíóú]+){2,})(\s[A-ZÁÉÍÓÚ]{1}([a-zñáéíóú]+){2,})?$/";
            $response = false;
            if (preg_match($regularString, $value)){
                $response = true;
            }
            return $response;
        }
    
        function checkDNI($value){
            $regularDNI = "/^[0-9]{8}$/";
            $response = false;
            if (preg_match($regularDNI, $value)){
                $response = true;
            }
            return $response; 
        }
    
    
        function checkPassword($value){
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
        
    }

?>