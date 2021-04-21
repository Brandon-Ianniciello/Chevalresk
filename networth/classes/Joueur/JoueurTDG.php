<?php

include_once __DIR__ . "/../../utils/connector.php";

class JoueurTDG extends DBAO
{
    private $tableName;
    private static $_instance = null;

    private function __construct()
    {
        Parent::__construct();
        $this->tableName = "Joueurs";
    }

    public static function getInstance()
    {

        if (is_null(self::$_instance))
            $_instance = new JoueurTDG();

        return $_instance;
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

    public function get_id_by_email($email)
    {
        try {
            $conn = $this->connect();
            $tableName = $this->tableName;
            $query = "SELECT idJoueur FROM $tableName WHERE courriel =:courriel";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':courriel', $email);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $result = $stmt->fetch();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        $conn = null;
        return $result;
    }

    public function get_isAdmin_by_id($id)
    {
        try {
            $conn = $this->connect();
            $tableName = $this->tableName;
            $query = "SELECT isAdmin FROM $tableName WHERE idJoueur =:idJoueur";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':idJoueur', $id);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $result = $stmt->fetchColumn();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        $conn = null;
        return $result;
    }

    public function get_gains_by_id($id){
        try {
            $conn = $this->connect();
            $tableName = $this->tableName;
            $query = "SELECT montantInitial FROM $tableName WHERE idJoueur =:idJoueur";
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

    public function get_photo_by_id($id){
        
        try {
            $conn = $this->connect();
            $tableName = $this->tableName;
            $query = "SELECT urlPhotoProfil FROM $tableName WHERE idJoueur =:idJoueur";
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

    public function get_by_email($email)
    {

        try {
            $conn = $this->connect();
            $tableName = $this->tableName;
            $query = "SELECT courriel FROM $tableName WHERE courriel =:courriel";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':courriel', $email);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $result = $stmt->fetch();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        $conn = null;
        return $result;
    }


    public function get_by_alias($alias)
    {

        try {
            $conn = $this->connect();
            $tableName = $this->tableName;
            $query = "SELECT alias FROM $tableName WHERE alias=:alias";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':alias', $alias);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $result = $stmt->fetchAll();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        $conn = null;
        return $result;
    }


    public function get_all_users()
    {

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

    public function get_all_userName()
    {

        try {
            $conn = $this->connect();
            $tableName = $this->tableName;
            $query = "SELECT alias FROM $tableName";
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


    public function add_user($alias, $nom, $prénom, $motDePasse, $courriel, $montantInitial, $isAdmin)
    {
        try {
            $conn = $this->connect();
            $tableName = $this->tableName;
            $query = "INSERT INTO $tableName (alias,nom,prénom,motDePasse,courriel,montantInitial,isAdmin) VALUES ('$alias','$nom','$prénom',
            '$motDePasse', '$courriel',$montantInitial,$isAdmin)";
            $stmt = $conn->prepare($query);
            $stmt->execute();
            $resp = true;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            $resp = false;
        }
        $conn = null;
        return $resp;
    }

    public function update_username($username, $id)
    {

        try {
            $conn = $this->connect();
            $tableName = $this->tableName;
            $query = "UPDATE $tableName SET alias=:alias WHERE idJoueur=:idJoueur";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':alias', $username);
            $stmt->bindParam(':idJoueur', $id);
            $stmt->execute();
            $resp = true;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            $resp = false;
        }
        $conn = null;
        return $resp;
    }

    public function update_email($email, $id)
    {

        try {
            $conn = $this->connect();
            $tableName = $this->tableName;
            $query = "UPDATE $tableName SET courriel=:courriel WHERE idJoueur=:idJoueur";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':courriel', $email);
            $stmt->bindParam(':idJoueur', $id);
            $stmt->execute();
            $resp = true;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            $resp = false;
        }
        $conn = null;
        return $resp;
    }

    public function update_password($NPW, $id)
    {
        try {
            $conn = $this->connect();
            $tableName = $this->tableName;
            $query = "UPDATE $tableName SET motDePasse=:motDePasse WHERE idJoueur=:idJoueur";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':motDePasse', $NPW);
            $stmt->bindParam(':idJoueur', $id);
            $stmt->execute();
            $resp = true;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            $resp = false;
        }
        $conn = null;
        return $resp;
    }

    public function update_montant_joueur($montant,$alias){
        try {
            $conn = $this->connect();
            $tableName = $this->tableName;
            $query = "UPDATE $tableName SET montantInitial=:montantInitial WHERE alias=:alias";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':montantInitial', $montant);
            $stmt->bindParam(':alias', $alias);
            $stmt->execute();
            $resp = true;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            $resp = false;
        }
        $conn = null;
        return $resp;
    }

    public function update_montant_joueur_by_id($montant,$id){
        try {
            $conn = $this->connect();
            $tableName = $this->tableName;
            $query = "UPDATE $tableName SET montantInitial=:montantInitial WHERE idJoueur=:idJoueur";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':montantInitial', $montant);
            $stmt->bindParam(':idJoueur', $id);
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
