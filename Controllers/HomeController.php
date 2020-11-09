<?php

    namespace Controllers;

    use Models\User as User;
    use Models\UserProfile as UserProfile;
    use Models\Role as Role;
    use DAO\UserDAO as UserDAO;
    use Controllers\MovieController as MovieController;
    use Controllers\CinemaController as CinemaController;
    use Utils\Utils as Utils;

    class HomeController{

        private $userDAO;
        private $utils;

        public function __construct(){
            $this->userDAO = new UserDAO();
            $this->utils = new Utils();
        }

        public function ShowLoginView($message = "", $email = ""){
            require_once(VIEWS_PATH."home.php");
        }
        
        public function ShowRegistrationView($errors = array(), $data = array()){
            require_once(VIEWS_PATH."registration.php");
        }

        public function Login($email, $password){
            $userList = $this->userDAO->GetAll();
            $flag = false;

            foreach($userList as $user){
                if($user->getEmail() == $email){
                    if($user->getPassword() == $password){
                        $_SESSION["email"] = $email;
                        $_SESSION["role"] = $user->getRole()->getDescription();
                        $_SESSION["idUser"] = $user->getId();
                        $flag = true;
                    }
                }
            }

            if($flag){
                if($_SESSION["role"] == 'admin'){
                    $cinema = new CinemaController();
                    $cinema->ShowCinemas();
                }
                else{
                    $movies = new MovieController();
                    $movies->ShowMovies();
                }
            }
            else{
                $this->ShowLoginView("The email or password is incorrect", $email);
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
                $data['name'] = $name;
                $data['lastname'] = $lastname;
                $data['dni'] = $dni;
                $data['email'] = $email;
                $data['password'] = $password;
                $this->ShowRegistrationView($errors, $data);
            }
        }

        public function Logout($message = ""){
            $_SESSION = array();
            session_destroy();
            $this->ShowLoginView($message);
        }

        private function checkData($name, $lastname, $dni, $email, $password){
            $errors = array();
            if (!$this->utils->checkString($name)) array_push($errors, "Invalid format. Name must be between 3 and 20 characters. And start with uppercase.");
            if (!$this->utils->checkString($lastname)) array_push($errors, "Invalid format. Lastname must be between 3 and 20 characters. And start with uppercase.");
            if (!$this->utils->checkDNI($dni)) array_push($errors, "Invalid format. DNI must have 8 numbers without spaces, periods or characters.");
            if (!$this->utils->checkEmail($email)) array_push($errors, "Invalid format. Example: 'example@domain.com'");
            if (!$this->utils->checkPassword($password)) array_push($errors, "Password must be at least 8 characters long with 1 uppercase 1 lowercase and 1 numeric character");

            return $errors;
        }      
        
    }

?>