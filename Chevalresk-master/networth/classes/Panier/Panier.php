<?php
include_once __DIR__ . "/../Items/ItemTDG.php";
include_once __DIR__ . "/PanierTDG.php";

class Panier
{

    private $idItem;
    private $idJoueur;
    private $quantite;
    /*CONSTRUCTEUR*/
    public function __construct()
    {
    }

    /*GETTERS*/
    public function get_id()
    {
        return $this->idItem;
    }

    public function get_idJoueur()
    {
        return $this->idJoueur;
    }
    public function get_quantite()
    {
        return $this->quantite;
    }
    public function set_id($id)
    {
        $this->idPotion = $id;
    }

    public function set_idItem($id)
    {
        $this->idItem = $id;
    }

    public function set_idJoueur($id)
    {
        $this->idJoueur = $id;
    }
    public function set_quantite($quantite)
    {
        $this->quantite = $quantite;
    }

    /*FONCTIONS*/
    public function load_panier($id)
    {
        try {
            $TDG = PanierTDG::getInstance();
            $res = $TDG->get_all_info_by_id($id);
            $inventaire = $res[0];

            $this->idItem = $inventaire['idItem'];
            $this->idJoueur = $inventaire['idJoueur'];
            $this->quantite = $inventaire['Quantite'];

            $TDG = null;
            return true;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function ajouter_item_panier($idItem, $idJoueur, $quantite)
    {
        //add item to DB
        $TDG = PanierTDG::getInstance();
        $res = $TDG->add_panier($idItem,$idJoueur,$quantite);
        $TDG = null;
        return $res;
    }

    public function supprimer_item_panier($idItem){
        $TDG = PanierTDG::getInstance();
        $res = $TDG->delete_from_panier($idItem);
        $TDG = null;
        return $res;
    }

    public function update_quantite_panier($quantite,$idJoueur,$idItem){
        $TDG =PanierTDG::getInstance();
        $res=$TDG->update_quantite($quantite,$idJoueur,$idItem);
        $TDG = null;
        return $res;
    }
}
