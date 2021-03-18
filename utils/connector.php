<?php

    //Database Access Object
    class DBAO {

        //données nécessaire a la creation d'une connection
        private $servername;
        private $username;
        private $password;
        private $dbname;
        private $charset;

        /*
        Serveur Linux (pour heberger votre PHP)
        Adresse du serveur: 167.114.152.54
        nom user: chevaleresk5
        mot de passe:btM5Ckg+
        */
        
        protected function __construct(){
            $this->servername = "167.114.152.54";
            $this->username = "chevaleresk5";
            $this->password = "btM5Ckg+";
            $this->dbname = "chevaleresk_DB";
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