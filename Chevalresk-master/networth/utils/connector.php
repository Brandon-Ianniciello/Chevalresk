<?php
    /*Connection aux données*/
    class DBAO {

        private $servername;
        private $username;
        private $password;
        private $dbname;
        private $charset;
        
        protected function __construct(){
            $this->servername = "167.114.152.54";
            $this->username = "chevalier5";
            $this->password = "d8kv94h6";
            $this->dbname = "dbchevalersk5";
            $this->charset = "utf8mb4";
        }

        protected function connect() {
            
            try{
                $dsn = "mysql:host=".$this->servername.";dbname=".$this->dbname.";charset=".$this->charset;
                $pdo = new PDO($dsn , $this->username, $this->password);
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                return $pdo;
            }

            catch(PDOException $e){
                echo "Connection failed: ", $e->getMessage();
            }
        }
    }

?>