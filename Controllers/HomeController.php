<?php

    namespace Controllers;

    use Models\User as User;
    use Models\UserProfile as UserProfile;
    use DAO\UserDAO as UserDAO;

    class HomeController{

        private $userDAO;

        public function __construct(){
            $this->userDAO = new UserDAO();
        }

        public function ShowLoginView($message = ""){
            require_once(VIEWS_PATH."home.php");
        }
        
        public function ShowRegistrationView(){
            require_once(VIEWS_PATH."registration.php");
        }

        public function Login($email, $password){
            $userList = $this->userDAO->GetAll();
            $flag = false;

            foreach($userList as $user){
                if($user->getEmail() == $email){
                    if($user->getPassword() == $password){
                        $_SESSION["email"] = $email;
                        $flag = true;
                    }
                }
            }

            if($flag){
            
                header("location", FRONT_ROOT . "Movie/ShowMovies");
                # El header este no redirige bien
                # Aca tiene que redirigir a la pagina principal
                #echo $_SESSION["email"];
            }
            else{
                $this->ShowLoginView("Los datos ingresados no son validos.");
            }
        }

        public function Register($name, $lastname, $dni, $email, $password){
            # En algun lado hay que validar la info que entra. Se puede hacer desde php o javascript

            # Agregar un comprobacion para ver que el email no este registrado previamente
            $user = new User();
            $profile = new UserProfile();

            $profile->setName($name);
            $profile->setLastname($lastname);
            $profile->setDni($dni);

            $user->setEmail($email);
            $user->setPassword($password);
            $user->setProfile($profile);
            $user->setRole('client');

            $this->userDAO->Add($user);

            $this->ShowLoginView("Tu cuenta ha sido creada");
        }

        public function Logout(){
            session_destroy();
            $this->ShowLoginView();
        }

    }

?>