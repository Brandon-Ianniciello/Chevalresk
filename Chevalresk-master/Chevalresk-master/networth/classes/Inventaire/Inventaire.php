<?php
include_once __DIR__ . "/../Items/ItemTDG.php";
include_once __DIR__ . "/InventaireTDG.php";

class Inventaire
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
    public function load_inventaire($id)
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

    public function ajouter_item_inventaire($idItem, $idJoueur, $quantite)
    {
        //add item to DB
        $TDG = InventaireTDG::getInstance();
        $res = $TDG->add_inventaire($idItem,$idJoueur,$quantite);
        $TDG = null;
        return $res;
    }

    public function supprimer_item_inventaire($idItem){
        $TDG = InventaireTDG::getInstance();
        $res = $TDG->delete_from_inventaire($idItem);
        $TDG = null;
        return $res;
    }
}
