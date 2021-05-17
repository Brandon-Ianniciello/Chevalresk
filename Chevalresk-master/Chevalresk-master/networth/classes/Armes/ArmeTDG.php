<?php

include_once __DIR__ . "/../../utils/connector.php";

class ArmeTDG extends DBAO{

    private $tableName;
    private static $_instance = null;

    /*CONSTRUCTEUR*/
    private function __construct()
    {
        Parent::__construct();
        $this->tableName = "Armes";
    }

    /*INSTANCE*/
    public static function getInstance()
    {
        if (is_null(self::$_instance))
            $_instance = new ArmeTDG();
        return $_instance;
    }

    /*FONCTIONS*/
    public function get_all_info_by_id($id)
    {
        try {
            $conn = $this->connect();
            $tableName = $this->tableName;
            $query = "SELECT * FROM $tableName WHERE idArme=:idArme";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':idArme', $id);
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
            $query = "SELECT idArme FROM $tableName WHERE idArme=:idArme";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':idArme', $id);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $result = $stmt->fetch();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        $conn = null;
        return $result;
    }

    public function get_by_efficacite($efficaciteArme)
    {

        try {
            $conn = $this->connect();
            $tableName = $this->tableName;
            $query = "SELECT efficaciteArme FROM $tableName WHERE efficaciteArme=:efficaciteArme";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':efficaciteArme', $efficaciteArme);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $result = $stmt->fetch();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        $conn = null;
        return $result;
    }

    public function get_by_genre($genreArme)
    {

        try {
            $conn = $this->connect();
            $tableName = $this->tableName;
            $query = "SELECT genreArme FROM $tableName WHERE genreArme=:genreArme";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':genreArme', $genreArme);
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
            $query = "SELECT descriptionArme FROM $tableName WHERE descriptionArme=:descriptionArme";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':descriptionArme', $description);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $result = $stmt->fetch();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        $conn = null;
        return $result;
    }
    
    public function get_all_armes(){
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

    public function add_arme($effcacite,$genre,$description){
        try{
            $conn = $this->connect();
            $tableName = $this->tableName;
            $query = "INSERT INTO $tableName(efficaciteArme,genreArme,descriptionArme)
            VALUES(:efficaciteArme,:genreArme,:descriptionArme)";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':efficaciteArme',$effcacite);
            $stmt->bindParam(':genreArme',$genre);
            $stmt->bindParam(':descriptionArme',$description);
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
