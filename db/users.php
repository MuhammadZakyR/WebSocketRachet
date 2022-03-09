<?php
    class users
    {
        private $id;
        private $name;
        private $email;
        private $loginStatus;
        private $lastLogin;
        public $dbConn;
        // UPDATE DATABASE USERS
        function setId($id) {$this->id = $id;}
        function getId() {return $this->id;}
        function setName($name) {$this->name = $name;}
        function getName() {return $this->name;}
        function setEmail($email) {$this->email = $email;}
        function getEmail() {return $this->email;}
        function setLoginStatus($loginStatus) {$this->loginStatus = $loginStatus;}
        function getLoginStatus() {return $this->loginStatus;}
        function setLastLogin($lastLogin) {$this->lastLogin = $lastLogin;}
        function getLastLogin() {return $this->lastLogin;}

        public function __construct()
        {
            require_once("db_Connect.php");
            $db = new dbConnect();
            $this->dbConn = $db->connect();
        }
        // Fungsi Menyimpan Data User
        public function save()
        {
            $sql = "INSERT INTO `tb_userwebsocket`(`id`, `username`, `email`, `login_status`, `last_login`) VALUES (null, :username, :email, :loginStatus, :lastLogin)";
            $stmt = $this->dbConn->prepare($sql);
            $stmt->bindParam(":username", $this->name);
            $stmt->bindParam(":email", $this->email);
            $stmt->bindParam(":loginStatus", $this->loginStatus);
            $stmt->bindParam(":lastLogin", $this->lastLogin);
            try
            {
                if($stmt->execute())
                {
                    return true;
                } else
                {
                    return false;
                }
            } catch (Exception $e)
            {
                echo $e->getMessage();
            }
        }
        // Fungsi Input Data Email User
        public function getUserByEmail()
        {
            $stmt = $this->dbConn->prepare('SELECT * FROM tb_userwebsocket Where email = :email');
            $stmt->bindParam(':email', $this->email);
            try
            {
                if($stmt->execute())
                {
                    $user = $stmt->fetch(PDO::FETCH_ASSOC);
                }
            }
            catch (Exception $e)
            {
                echo $e->getMessage();
            }
            return $user;
        }
        // Fungsi Input Data Id User
        public function getUserById()
        {
            $stmt = $this->dbConn->prepare('SELECT * FROM tb_userwebsocket Where id = :id');
            $stmt->bindParam(':id', $this->id);
            try
            {
                if($stmt->execute())
                {
                    $user = $stmt->fetch(PDO::FETCH_ASSOC);
                }
            }
            catch (Exception $e)
            {
                echo $e->getMessage();
            }
            return $user;
        }
        // Fungsi Update Status Login User Terdaftar
        public function updateLoginStatus()
        {
            $stmt = $this->dbConn->prepare('UPDATE tb_userwebsocket SET login_status = :loginStatus, last_login = :lastLogin WHERE id = :id');
            $stmt->bindParam(":loginStatus", $this->loginStatus);
            $stmt->bindParam(":lastLogin", $this->lastLogin);
            $stmt->bindParam(":id", $this->id);      
            try
            {
                if($stmt->execute())
                {
                    return true;
                }
                else
                {
                    return false;
                }
            }
            catch (Exception $e)
            {
                echo $e->getMessage();
            }
        }
        // FUNGSI MENGAMBIL DATA USER
        public function getAllUsers()
        {
            $stmt = $this->dbConn->prepare("SELECT * FROM tb_userwebsocket");
            $stmt->execute();
            $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $users;
        }
    }
?>