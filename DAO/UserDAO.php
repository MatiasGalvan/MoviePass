<?php

    namespace DAO;

    use \Exception as Exception;
    use DAO\Connection as Connection;
    use DAO\IUserDAO as IUserDAO;
    use Models\User as User;
    use Models\UserProfile as UserProfile;
    use Models\Role as Role;
    use Models\Ticket as Ticket;

    class UserDAO implements IUserDAO{

        private $connection;
        private $tableName = "User";
        private $tickets;

        public function __construct(){
            $this->tickets = new TicketDAO();
        }

        public function Add(User $user){
            try{
                $query = "INSERT INTO ".$this->tableName." (email, pass, dni, firstname, lastname, idrole) VALUES (:email, :pass, :dni, :firstname, :lastname, :idrole);";
                
                $parameters["email"] = $user->getEmail();
                $parameters["pass"] = $user->getPassword();
                $profile = new UserProfile();
                $profile = $user->getProfile();
                $parameters["dni"] = $profile->getDni();
                $parameters["firstname"] = $profile->getName();
                $parameters["lastname"] = $profile->getLastname();
                $parameters["idrole"] = 1;

                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query, $parameters);
            }
            catch(Exception $ex){
                throw $ex;
            }
        }

        public function GetAll(){
            try{
                $userList = array();

                $query = "SELECT u.*, r.roleName FROM ".$this->tableName." u INNER JOIN role r ON u.idRole = r.idRole";

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);
                
                foreach ($resultSet as $row){                

                    $user = new User();
                    $profile = new UserProfile();
                    $role = new Role();

                    $user->setId($row["idUser"]);
                    $user->setEmail($row["email"]);
                    $user->setPassword($row["pass"]);

                    $profile->setDni($row["dni"]);
                    $profile->setName($row["firstname"]);
                    $profile->setLastname($row["lastname"]);

                    $role->setDescription($row["roleName"]);

                    $user->setProfile($profile);
                    $user->setRole($role);

                    $user->setTickets($this->tickets->GetTickets($row["idUser"]));

                    array_push($userList, $user);
                }

                return $userList;
            }
            catch(Exception $ex){
                throw $ex;
            }
        }

        public function Remove($email){
            try{
                $query = "DELETE FROM ".$this->tableName." WHERE email = :email";
                $param['email'] = $email;

                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query, $param);                
            }
            catch(Exception $ex){
                throw $ex;
            }
        }

        public function Exist($email){
            try{
                $response = false;
                $query = "SELECT email FROM ".$this->tableName." WHERE email = :email";
                $param['email'] = $email;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query, $param);

                foreach ($resultSet as $row){   
                    if($row['email'] != null){
                        $response = true;
                    }
                }

                return $response;
            }
            catch(Exception $ex){
                throw $ex;
            }
        }

        public function GetByEmail($email){
            try{
                $query = "SELECT idUser FROM ".$this->tableName." WHERE email = :email";
                $param['email'] = $email;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query, $param);
 
                foreach ($resultSet as $row){                
                    $id = $row["idUser"];
                }
                return $id;
            }
            catch(Exception $ex){
                throw $ex;
            }
        }



    }

?>