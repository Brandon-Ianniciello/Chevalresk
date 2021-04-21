<?php

include_once __DIR__ . "/../../utils/connector.php";

class ArmureTDG extends DBAO{

    private $tableName;
    private static $_instance = null;

    /*CONSTRUCTEUR*/
    private function __construct()
    {
        Parent::__construct();
        $this->tableName = "Armures";
    }

    /*INSTANCE*/
    public static function getInstance()
    {
        if (is_null(self::$_instance))
            $_instance = new ArmureTDG();
        return $_instance;
    }

    /*FONCTIONS*/
    public function get_all_info_by_id($id)
    {
        try {
            $conn = $this->connect();
            $tableName = $this->tableName;
            $query = "SELECT * FROM $tableName WHERE idArmure=:idArmure";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':idArmure', $id);
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
            $query = "SELECT idArmure FROM $tableName WHERE idArmure=:idArmure";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':idArmure', $id);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $result = $stmt->fetch();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        $conn = null;
        return $result;
    }

    public function get_by_matière($matière)
    {

        try {
            $conn = $this->connect();
            $tableName = $this->tableName;
            $query = "SELECT matièreArmure FROM $tableName WHERE matièreArmure=:matièreArmure";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':matièreArmure', $matière);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $result = $stmt->fetch();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        $conn = null;
        return $result;
    }

    public function get_by_poids($poids)
    {

        try {
            $conn = $this->connect();
            $tableName = $this->tableName;
            $query = "SELECT poidsArmure FROM $tableName WHERE poidsArmure=:poidsArmure";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':poidsArmure', $poids);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $result = $stmt->fetch();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        $conn = null;
        return $result;
    }

    public function get_by_taille($tailleArmure)
    {

        try {
            $conn = $this->connect();
            $tableName = $this->tableName;
            $query = "SELECT tailleArmure FROM $tableName WHERE tailleArmure=:tailleArmure";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':tailleArmure', $tailleArmure);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $result = $stmt->fetch();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        $conn = null;
        return $result;
    }
    
    public function get_all_armures(){
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

    public function add_armure($matière,$poids,$taille){
        //ID DE L'ITEM ???
        try{
            $conn = $this->connect();
            $tableName = $this->tableName;
            $query = "INSERT INTO $tableName VALUES(:matièreArmure,:poidsArmure,:tailleArmure)";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':matièreArmure',$matière);
            $stmt->bindParam(':poidsArmure',$poids);
            $stmt->bindParam(':tailleArmure',$taille);
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
