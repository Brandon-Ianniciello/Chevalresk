<?php

include_once __DIR__ . "/../../utils/connector.php";

class PotionTDG extends DBAO{

    private $tableName;
    private static $_instance = null;

    /*CONSTRUCTEUR*/
    private function __construct()
    {
        Parent::__construct();
        $this->tableName = "Potions";
    }

    /*INSTANCE*/
    public static function getInstance()
    {
        if (is_null(self::$_instance))
            $_instance = new PotionTDG();
        return $_instance;
    }

    /*FONCTIONS*/
    public function get_all_info_by_id($id)
    {
        try {
            $conn = $this->connect();
            $tableName = $this->tableName;
            $query = "SELECT * FROM $tableName WHERE idPotion=:idPotion";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':idPotion', $id);
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
            $query = "SELECT idPotion FROM $tableName WHERE idPotion=:idPotion";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':idPotion', $id);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $result = $stmt->fetch();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        $conn = null;
        return $result;
    }

    public function get_by_effet($effet)
    {

        try {
            $conn = $this->connect();
            $tableName = $this->tableName;
            $query = "SELECT effetPotion FROM $tableName WHERE effetPotion=:effetPotion";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':effetPotion', $effet);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $result = $stmt->fetch();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        $conn = null;
        return $result;
    }

    public function get_by_durée($durée)
    {

        try {
            $conn = $this->connect();
            $tableName = $this->tableName;
            $query = "SELECT duréePotion FROM $tableName WHERE duréePotion=:duréePotion";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':duréePotion', $durée);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $result = $stmt->fetch();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        $conn = null;
        return $result;
    }
    
    public function get_all_potions(){
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

    public function add_potion($effet,$durée){
        //ID DE La potion ???
        try{
            $conn = $this->connect();
            $tableName = $this->tableName;
            $query = "INSERT INTO $tableName VALUES(:effetPotion,:duréePotion)";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':effetPotion',$effet);
            $stmt->bindParam(':duréePotion',$durée);
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
