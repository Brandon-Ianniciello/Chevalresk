<?php

include_once __DIR__ . "/RessourceTDG.php";

class Ressource
{
    private $descriptionRessource;
    private $idRessource;

    /*CONSTRUCTEUR*/
    public function __construct()
    {
    }

    /*GETTERS*/
    public function get_id()
    {
        return $this->idRessource;
    }

    public function get_description()
    {
        return $this->descriptionRessource;
    }

    /*SETTERS*/
    public function set_id($id)
    {
        $this->idRessource = $id;
    }

    public function set_descriptionRessource($description)
    {
        $this->descriptionRessource = $description;
    }

   
    /*FONCTIONS*/
    public function load_ressource($id)
    {
        try{
            $TDG = RessourceTDG::getInstance();
            $res = $TDG->get_all_info_by_id($id);
            $ressource = $res[0];
    
            $this->idRessource = $ressource['idItem'];
            $this->descriptionRessource = $ressource['Description'];

            $TDG = null;
            return true;
        }
        catch(PDOException $e){
            echo "Error: " . $e->getMessage();
        }
      
    }

    public function add_ressource($description){
        $TDG = RessourceTDG::getInstance();
        $res = $TDG->add_ressource($description);
        $TDG = null;
        return $res;
    }
}