<?php

include_once __DIR__ . "/../../utils/connector.php";

class PanierTDG extends DBAO
{
    private $tableName;
    private static $_instance = null;

    private function __construct()
    {
        Parent::__construct();
        $this->tableName = "Panier";
    }

    public static function getInstance()
    {
        if (is_null(self::$_instance))
            $_instance = new PanierTDG();

        return $_instance;
    }

    public function get_all_panier(){
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

    public function get_all_info_by_id($id)
    {
        try {
            $conn = $this->connect();
            $tableName = $this->tableName;
            $query = "SELECT * FROM $tableName WHERE idJoueur=:idJoueur";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':idJoueur', $id);
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
            $query = "SELECT idJoueur FROM $tableName WHERE idJoueur=:idJoueur";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':idJoueur', $id);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $result = $stmt->fetch();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        $conn = null;
        return $result;
    }

    public function get_quantite_by_idItem($idItem)
    {
        try {
            $conn = $this->connect();
            $tableName = $this->tableName;
            $query = "SELECT Quantite FROM $tableName WHERE idItem=:idItem";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':idItem', $idItem);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $result = $stmt->fetch();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        $conn = null;
        return $result;
    }
  

    public function update_quantite($quantite,$idJoueur,$idItem)
    {
        try {
            $conn = $this->connect();
            $tableName = $this->tableName;
            $query = "UPDATE $tableName SET Quantite=:quantite WHERE idJoueur=:idJoueur and idItem=:idItem";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':quantite', $quantite);
            $stmt->bindParam(':idJoueur', $idJoueur);
            $stmt->bindParam(':idItem', $idItem);
            $stmt->execute();
            $resp = true;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            $resp = false;
        }
        $conn = null;
        return $resp;
    }

    public function add_panier($idItem,$idJoueur,$quantite){        
        try{
            $conn = $this->connect();
            $tableName = $this->tableName;

            $query = "INSERT INTO $tableName (idItem,idJoueur,Quantite)VALUES(:idItem,:idJoueur,:Quantite)";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':idItem',$idItem);
            $stmt->bindParam(':idJoueur',$idJoueur);
            $stmt->bindParam(':Quantite',$quantite);

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

    public function delete_from_panier($idItem){        
        try{
            $conn = $this->connect();
            $tableName = $this->tableName;

            $query = "DELETE FROM $tableName WHERE idItem=:idItem";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':idItem',$idItem);
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
