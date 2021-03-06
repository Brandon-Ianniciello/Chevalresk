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

    public function get_by_dur??e($dur??e)
    {

        try {
            $conn = $this->connect();
            $tableName = $this->tableName;
            $query = "SELECT dur??ePotion FROM $tableName WHERE dur??ePotion=:dur??ePotion";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':dur??ePotion', $dur??e);
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

    public function add_potion($effet,$dur??e){
        try{
            $conn = $this->connect();
            $tableName = $this->tableName;
            $query = "INSERT INTO $tableName (effetPotion,dur??ePotion) VALUES ('$effet','$dur??e');";
            $stmt = $conn->prepare($query);
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
