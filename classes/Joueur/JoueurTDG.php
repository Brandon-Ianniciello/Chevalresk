<?php

include_once __DIR__ . "/../../utils/connector.php";

class JoueurTDG extends DBAO
{
    private $tableName;
    private static $_instance = null;

    private function __construct(){
        Parent::__construct();
        $this->tableName = "Joueurs";
    }

    public static function getInstance() {

        if(is_null(self::$_instance))
            $_instance = new JoueurTDG();

        return $_instance;
    }

    public function get_all_info_by_id($id){

        try{
            $conn = $this->connect();
            $tableName = $this->tableName;
            $query = "SELECT * FROM $tableName WHERE idJoueur=:idJoueur";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':idJoueur', $id);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $result = $stmt->fetch();
        }

        catch(PDOException $e)
        {
            echo "Error: " . $e->getMessage();
        }
        $conn = null;
        return $result;
    }

    public function get_by_id($id){

        try{
            $conn = $this->connect();
            $tableName = $this->tableName;
            $query = "SELECT idJoueur FROM $tableName WHERE idJoueur=:idJoueur";//select * ?
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':idJoueur', $id);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $result = $stmt->fetch();
        }

        catch(PDOException $e)
        {
            echo "Error: " . $e->getMessage();
        }
        $conn = null;
        return $result;
    }

    public function get_id_by_email($email){
        try{
            $conn = $this->connect();
            $tableName = $this->tableName;
            $query = "SELECT idJoueur FROM $tableName WHERE courriel =:courriel";//select * ?
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':courriel', $email);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $result = $stmt->fetch();
        }
        catch(PDOException $e)
        {
            echo "Error: " . $e->getMessage();
        }
        $conn = null;
        return $result;
    }

    public function get_by_email($email){

        try{
            $conn = $this->connect();
            $tableName = $this->tableName;
            $query = "SELECT courriel FROM $tableName WHERE courriel =:courriel";//select * ?
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':courriel', $email);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $result = $stmt->fetch();
        }

        catch(PDOException $e)
        {
            echo "Error: " . $e->getMessage();
        }
        $conn = null;
        return $result;
    }


    public function get_by_alias($alias){

        try
        {
            $conn = $this->connect();
            $tableName = $this->tableName;
            $query = "SELECT alias FROM $tableName WHERE alias=:alias";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':alias', $alias);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $result = $stmt->fetchAll();
        }

        catch(PDOException $e)
        {
            echo "Error: " . $e->getMessage();
        }
        $conn = null;
        return $result;
    }


    public function get_all_users(){

        try{
            $conn = $this->connect();
            $tableName = $this->tableName;
            $query = "SELECT * FROM $tableName";
            $stmt = $conn->prepare($query);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $result = $stmt->fetchAll();
        }

        catch(PDOException $e)
        {
            echo "Error: " . $e->getMessage();
        }
        $conn = null;
        return $result;
    }


    public function add_user($alias, $nom,$prénom,$motDepasse, $courriel,$montantInitial,$isAdmin){

        try{
            $conn = $this->connect();
            $tableName = $this->tableName;
            $query = "INSERT INTO $tableName VALUES (:alias, :nom,:prénom,:motDepasse, :courriel,:montantInitial,:isAdmin)";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':alias', $alias);
            $stmt->bindParam(':nom', $nom);
            $stmt->bindParam(':prénom', $prénom);
            $stmt->bindParam(':motDepasse', $motDepasse);
            $stmt->bindParam(':courriel', $courriel);
            $stmt->bindParam(':montantInitial', $montantInitial);
            $stmt->bindParam(':isAdmin',$isAdmin);
            $stmt->execute();
            $resp =  true;
        }
        catch(PDOException $e)
        {
            $resp =  false;
        }
        $conn = null;
        return $resp;
    }


    /*
      update juste pour les infos non sensibles
    */
    public function update_info($email, $username, $id){

        try{
            $conn = $this->connect();
            $tableName = $this->tableName;
            $query = "UPDATE $tableName SET email=:email, username=:username WHERE id=:id";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $resp = true;
        }

        catch(PDOException $e)
        {
            $resp = false;
        }
        //fermeture de connection PDO
        $conn = null;
        return $resp;
    }

    /*
      update juste pour le password
    */
    public function update_password($NHP, $id){

        try{
            $conn = $this->connect();
            $tableName = $this->tableName;
            $query = "UPDATE $tableName SET passwordhash=:passwordhash WHERE id=:id";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':passwordhash', $NHP);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $resp = true;
        }

        catch(PDOException $e)
        {
            $resp = false;
        }
        //fermeture de connection PDO
        $conn = null;
        return $resp;
    }
}
