<?php

include_once __DIR__ . "/EvaluationTDG.php";

class Evaluation
{
    private $NbrÉtoile;
    private $Commentaire;
    private $idJoueur;
    private $idItem;

    /*CONSTRUCTEUR*/
    public function __construct()
    {
    }


    /*FONCTIONS*/
    public function load_evaluation_by_idJoueur($id)
    {
        try {
            $TDG = EvaluationTDG::getInstance();
            $res = $TDG->get_all_info_by_id($id);
            $evalutaion = $res[0];

            $this->NbrÉtoile = $evalutaion['NbrÉtoile'];
            $this->Commentaire = $evalutaion['Commentaire'];
            $this->idJoueur = $evalutaion['idJoueur'];
            $this->idItem = $evalutaion['idItem'];

            $TDG = null;
            return true;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function add_evalutaion($NbrÉtoile,$Commentaire,$idJoueur,$idItem){
        try
        {
            $TDG = EvaluationTDG::getInstance();
            $res = $TDG->add_evaluation($NbrÉtoile,$Commentaire,$idJoueur,$idItem);
            $TDG = null;
            return $res;
        }catch(PDOException $e){    
            echo "Error: " . $e->getMessage();
        }
    }
}
