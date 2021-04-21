<?php
include_once __DIR__ . "/ItemTDG.php";

class Item
{

    private $idItem;
    private $nomItem;
    private $quantiteStockItems;
    private $typeItem;
    private $prixItem;
    private $photoItem;

    /*CONSTRUCTEUR*/
    public function __construct()
    {
    }

    /*GETTERS*/
    public function get_id()
    {
        return $this->idItem;
    }

    public function get_nomItem()
    {
        return $this->nomItem;
    }

    public function get_quantiteStockItems()
    {
        return $this->quantiteStockItems;
    }

    public function get_typeItem()
    {
        return $this->typeItem;
    }

    public function get_prixItem()
    {
        return $this->prixItem;
    }

    public function get_photoItem()
    {
        return $this->photoItem;
    }

    /*SETTERS*/
    public function set_id($id)
    {
        $this->idItem = $id;
    }

    public function set_nomItem($nom)
    {
        $this->nomItem = $nom;
    }

    public function set_quantiteStockItems($qnt)
    {
        $this->quantiteStockItems = $qnt;
    }

    public function set_typeItem($type)
    {
        $this->typeItem = $type;
    }

    public function set_prixItem($prix)
    {
        $this->prixItem = $prix;
    }

    public function set_photoItem($urlPhoto)
    {
        $this->photoItem = $urlPhoto;
    }

    /*FONCTIONS*/
    public function load_item($id)
    {
        try{
            $TDG = itemTDG::getInstance();
            $res = $TDG->get_all_info_by_id($id);
            $item = $res[0];
    
            $this->idItem = $item['idItem'];
            $this->nomItem = $item['nomItem'];
            $this->quantiteStockItems =$item['quantiteStockItems'];
            $this->typeItem = $item['typeItem'];
            $this->prixItem = $item['prixItem'];
            $this->photoItem = $item['photoItem'];
    
            $TDG = null;
            return true;
        }
        catch(PDOException $e){
            echo "Error: " . $e->getMessage();
        }
      
    }

    public function ajouter_item($nom,$qt,$type,$prix,$photoItem){
        
        //add item to DB
        $TDG = itemTDG::getInstance();
        $res = $TDG->add_item($nom,$qt,$type,$prix,$photoItem);
        $TDG = null;
        return $res;
    }

    public function supprimer_item($nom,$type){
        $TDG = itemTDG::getInstance();
        $res = $TDG->delete_item($nom,$type);
        $TDG = null;
        return $res;
    }
}
