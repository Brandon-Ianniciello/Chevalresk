<?php

include_once __DIR__ . "/../../utils/connector.php";

class RessourceTDG extends DBAO{

    private $tableName;
    private static $_instance = null;

    /*CONSTRUCTEUR*/
    private function __construct()
    {
        Parent::__construct();
        $this->tableName = "Ressources";
    }

    /*INSTANCE*/
    public static function getInstance()
    {
        if (is_null(self::$_instance))
            $_instance = new RessourceTDG();
        return $_instance;
    }

    /*FONCTIONS*/
    public function get_all_info_by_id($id)
    {
        try {
            $conn = $this->connect();
            $tableName = $this->tableName;
            $query = "SELECT * FROM $tableName WHERE idItem=:idItem";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':idItem', $id);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $result = $stmt->fetchAll();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        $conn = null;
        return $result;
    }

    public function get_by_id($id)
    {

        try {
            $conn = $this->connect();
            $tableName = $this->tableName;
            $query = "SELECT idItem FROM $tableName WHERE idItem=:idItem";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':idItem', $id);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $result = $stmt->fetch();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        $conn = null;
        return $result;
    }


    public function get_by_description($description)
    {
        try {
            $conn = $this->connect();
            $tableName = $this->tableName;
            $query = "SELECT Description FROM $tableName WHERE Description=:description";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':description', $description);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $result = $stmt->fetch();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        $conn = null;
        return $result;
    }
    
    public function get_all_ressources(){
        try {
            $conn = $this->connect();
            $tableName = $this->tableName;
            $query = "SELECT * FROM $tableName";
            $stmt = $conn->prepare($query);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $result = $stmt->fetchAll();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        $conn = null;
        return $result;
    }

    public function add_ressource($description){
        try{
            $conn = $this->connect();
            $tableName = $this->tableName;
            $query = "INSERT INTO $tableName(Description)
            VALUES(:descriptionRessource)";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':descriptionRessource',$description);
            $stmt->execute();
            $resp = true;
        }
        catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            $resp = false;
        }
        $conn = null;
        return $resp;
    }
}
