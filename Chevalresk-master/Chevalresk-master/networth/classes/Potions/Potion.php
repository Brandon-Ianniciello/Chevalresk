<?php

include_once __DIR__ . "/PotionTDG.php";

class Potion
{
    private $duréePotion;
    private $effetPotion;
    private $idPotion;

    /*CONSTRUCTEUR*/
    public function __construct()
    {
    }

    /*GETTERS*/
    public function get_id()
    {
        return $this->idPotion;
    }

    public function get_duréePotion()
    {
        return $this->duréePotion;
    }

    public function get_effetPotion()
    {
        return $this->effetPotion;
    }

    /*SETTERS*/
    public function set_id($id)
    {
        $this->idPotion = $id;
    }

    public function set_duréePotion($durée)
    {
        $this->duréePotion = $durée;
    }

    public function set_effetPotion($effet)
    {
        $this->effetPotion = $effet;
    }
   
    /*FONCTIONS*/
    public function load_potion($id)
    {
        try{
            $TDG = ArmureTDG::getInstance();
            $res = $TDG->get_all_info_by_id($id);
            $potion = $res[0];
    
            $this->idPotion = $potion['idPotion'];
            $this->effetPotion = $potion['effetPotion'];
            $this->duréePotion =$potion['duréePotion'];

            $TDG = null;
            return true;
        }
        catch(PDOException $e){
            echo "Error: " . $e->getMessage();
        }
      
    }

    public function add_potion($duréePotion, $effetPotion){
        $TDG = PotionTDG::getInstance();
        $res = $TDG->add_potion($effetPotion,$duréePotion);
        $TDG = null;
        return $res;
    }
}