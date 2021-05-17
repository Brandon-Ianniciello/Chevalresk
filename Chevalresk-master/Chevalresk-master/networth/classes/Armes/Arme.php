<?php

include_once __DIR__ . "/ArmeTDG.php";

class Arme
{
    private $efficaciteArme;
    private $genreArme;
    private $descriptionArme;
    private $idArme;

    /*CONSTRUCTEUR*/
    public function __construct()
    {
    }

    /*GETTERS*/
    public function get_id()
    {
        return $this->idArme;
    }

    public function get_genreArme()
    {
        return $this->genreArme;
    }

    public function get_efficaciteArme()
    {
        return $this->efficaciteArme;
    }

    public function get_descriptionArme()
    {
        return $this->descriptionArme;
    }


    /*SETTERS*/
    public function set_id($id)
    {
        $this->idArme = $id;
    }

    public function set_descriptionArme($description)
    {
        $this->descriptionArme = $description;
    }

    public function set_efficaciteArme($efficacite)
    {
        $this->efficaciteArme = $efficacite;
    }

    public function set_genreArme($genreArme)
    {
        $this->genreArme = $genreArme;
    }

   
    /*FONCTIONS*/
    public function load_arme($id)
    {
        try{
            $TDG = ArmeTDG::getInstance();
            $res = $TDG->get_all_info_by_id($id);
            $arme = $res[0];
    
            $this->idArme = $arme['idArme'];
            $this->efficaciteArme = $arme['efficaciteArme'];
            $this->genreArme =$arme['genreArme'];
            $this->descriptionArme = $arme['descriptionArme'];

            $TDG = null;
            return true;
        }
        catch(PDOException $e){
            echo "Error: " . $e->getMessage();
        }
      
    }

    public function add_arme($efficacite, $genre, $descriptionArme){
        $TDG = ArmeTDG::getInstance();
        $res = $TDG->add_arme($efficacite, $genre, $descriptionArme);
        $TDG = null;
        return $res;
    }
}