<?php

include_once __DIR__ . "/../../utils/connector.php";

class itemTDG extends DBAO{

    private $tableName;
    private static $_instance = null;

    /*CONSTRUCTEUR*/
    private function __construct()
    {
        Parent::__construct();
        $this->tableName = "Items";
    }

    /*INSTANCE*/
    public static function getInstance()
    {
        if (is_null(self::$_instance))
            $_instance = new itemTDG();
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
    
    public function get_all_info_by_name($name)
    {   
        try {
            $conn = $this->connect();
            $tableName = $this->tableName;
            $query = "SELECT * FROM $tableName WHERE nomItem=:nomItem";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':nomItem', $name['nomItem']);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $result = $stmt->fetchAll();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        $conn = null;
        return $result;
    }
    public function get_all_info_by_type($type)
    {   
        try {
            $conn = $this->connect();
            $tableName = $this->tableName;
            $query = "SELECT * FROM $tableName WHERE typeItem=:typeItem";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':typeItem', $type['typeItem']);
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


    public function get_quantiteStock_by_id($id)
    {

        try {
            $conn = $this->connect();
            $tableName = $this->tableName;
            $query = "SELECT quantiteStockItems FROM $tableName WHERE idItem=:idItem";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':idItem', $id);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $result = $stmt->fetchColumn();//renvoie seulement la quantite en stock et non un tab
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        $conn = null;
        return $result;
    }

    public function get_prix_by_id($id){
        try {
            $conn = $this->connect();
            $tableName = $this->tableName;
            $query = "SELECT prixItem FROM $tableName WHERE idItem=:idItem";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':idItem', $id);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $result = $stmt->fetchColumn();//renvoie seulement la quantite en stock et non un tab
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        $conn = null;
        return $result;
    }
    
    public function get_by_nom($nom)
    {

        try {
            $conn = $this->connect();
            $tableName = $this->tableName;
            $query = "SELECT nomItem FROM $tableName WHERE nomItem=:nomItem";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':nomItem', $nom);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $result = $stmt->fetch();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        $conn = null;
        return $result;
    }

    public function get_by_type($type)
    {

        try {
            $conn = $this->connect();
            $tableName = $this->tableName;
            $query = "SELECT typeItem FROM $tableName WHERE typeItem=:typeItem";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':typeItem', $type);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $result = $stmt->fetch();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        $conn = null;
        return $result;
    }
    
    public function get_all_items(){
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

    public function add_item($nomItem,$quantiteStockItems,$type,$prix,$url){        
        try{
            $conn = $this->connect();
            $tableName = $this->tableName;

            $query = "INSERT INTO $tableName (nomItem,quantiteStockItems,typeItem,prixItem,photoItem)
            VALUES(:nomItem,:quantiteStockItems,
            :typeItem,:prixItem,:photoItem)";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':nomItem',$nomItem);
            $stmt->bindParam(':quantiteStockItems',$quantiteStockItems);
            $stmt->bindParam(':typeItem',$type);
            $stmt->bindParam(':prixItem',$prix);
            $stmt->bindParam(':photoItem',$url);
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

    public function delete_item($nom,$type){
        try{
            $conn = $this->connect();
            $tableName = $this->tableName;
            $query = "DELETE FROM $tableName WHERE nomItem=:nomItem and typeItem=:typeItem";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':nomItem',$nom);
            $stmt->bindParam(':typeItem',$type);
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

    public function update_quantiteStock($id,$quantite){
        try {
            $conn = $this->connect();
            $tableName = $this->tableName;
            $query = "UPDATE $tableName SET quantiteStockItems=:quantiteStockItems WHERE idItem=:idItem";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':quantiteStockItems', $quantite);
            $stmt->bindParam(':idItem', $id);
            $stmt->execute();
            $resp = true;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            $resp = false;
        }
        $conn = null;
        return $resp;
    }
}
