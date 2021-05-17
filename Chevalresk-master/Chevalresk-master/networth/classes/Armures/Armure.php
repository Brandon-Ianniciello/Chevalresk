<?php

include_once __DIR__ . "/ArmureTDG.php";

class Armure
{
    private $matièreArmure;
    private $poidsArmure;
    private $tailleArmure;
    private $idArmure;

    /*CONSTRUCTEUR*/
    public function __construct()
    {
    }

    /*GETTERS*/
    public function get_id()
    {
        return $this->idArmure;
    }

    public function get_poidsArmure()
    {
        return $this->poidsArmure;
    }

    public function get_tailleArmure()
    {
        return $this->tailleArmure;
    }

    public function get_matièreArmure()
    {
        return $this->matièreArmure;
    }


    /*SETTERS*/
    public function set_id($id)
    {
        $this->idArmure = $id;
    }

    public function set_poidsArmure($poids)
    {
        $this->poidsArmure = $poids;
    }

    public function set_tailleArmure($taille)
    {
        $this->tailleArmure = $taille;
    }

    public function set_matièreArmure($matièreArmure)
    {
        $this->matièreArmure = $matièreArmure;
    }

   
    /*FONCTIONS*/
    public function load_armure($id)
    {
        try{
            $TDG = ArmureTDG::getInstance();
            $res = $TDG->get_all_info_by_id($id);
            $armure = $res[0];
    
            $this->idArmure = $armure['id'];
            $this->matièreArmure = $armure['matièreArmure'];
            $this->poidsArmure =$armure['poidsArmure'];
            $this->tailleArmure = $armure['tailleArmure'];
            
            $TDG = null;
            return true;
        }
        catch(PDOException $e){
            echo "Error: " . $e->getMessage();
        }
      
    }

    public function add_armure($poids, $taille, $matière){
        $TDG = ArmureTDG::getInstance();
        $res = $TDG->add_armure($matière,$poids, $taille);
        $TDG = null;
        return $res;
    }
}