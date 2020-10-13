<?php

    namespace Controllers;

    use Models\User as User;
    use Models\UserProfile as UserProfile;
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
                        $_SESSION["email"] = $email;
                        $flag = true;
                    }
                }
            }

            if($flag){
            
                #header("location:". FRONT_ROOT . "Movie/ShowMovies");
                $movies = new MovieController();
                $movies->ShowMovies();

                # require_once(FRONT_ROOT."Movie/ShowMovies");
                # Aca tiene que redirigir a la pagina principal
                # echo $_SESSION["email"];
            }
            else{
                $this->ShowLoginView("Los datos ingresados no son validos.");
            }
        }

        public function Register($name, $lastname, $dni, $email, $password){
            # En algun lado hay que validar la info que entra. Se puede hacer desde php o javascript

            # Agregar un comprobacion para ver que el email no este registrado previamente
            $errors = $this->checkData($name, $lastname, $dni, $email, $password);
            if(count($errors) == 0){
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
            if (!$this->checkString($name)) array_push($errors, "El nombre ingresado no es valido. Debe comenzar con mayuscula y tener entre 3 y 20 caracteres.");
            if (!$this->checkString($lastname)) array_push($errors, "El apellido ingresado no es valido. Debe comenzar con mayuscula y tener entre 3 y 20 caracteres.");
            if (!$this->checkDNI($dni)) array_push($errors, "El DNI ingresado no es valido. Debe tener 8 numeros sin espacios, puntos u otros caracteres.");
            if (!$this->checkEmail($email)) array_push($errors, "El email ingresado no es valido. Ejemplo: 'example@domain.com'");
            if (!$this->checkPassword($password)) array_push($errors, "Entre 8-15 caracteres - 1 Mayúscula - 1 Minucula - 1 Dígito - Sin espacios");

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