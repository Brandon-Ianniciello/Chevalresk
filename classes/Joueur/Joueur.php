<?php
include_once __DIR__ . "/JoueurTDG.php";

class Joueur{

    private $idJoueur;
    private $alias;
    private $nom;
    private $prénom;
    private $motDePasse;
    private $mdpCrypte;
    private $courriel;
    private $montantInitial;
    private $isAdmin;

    /*Constructeur*/
    public function __construct(){}

    /*Getters*/
    public function get_id(){
        return $this->idJoueur;
    }

    public function get_courriel(){
        return $this->courriel;
    }

    public function get_alias(){
        return $this->alias;
    }

    public function get_mdp(){
        return $this->motDePasse;
    }

    public function get_mdpCrypte(){
        return $this->mdpCrypte;
    }

    public function get_nom(){
        return $this->nom;
    }

    public function get_prénom(){
        return $this->prénom;
    }

    public function get_montantInitial(){
        return $this->montantInitial;
    }

    public function get_isAdmin(){
        return $this->isAdmin;
    }

    /*Setters*/
    public function set_courriel($courriel){
        $this->courriel = $courriel;
    }

    public function set_nom($nom){
        $this->nom = $nom;
    }

    public function set_prénom($prénom){
        $this->prénom = $prénom;
    }

    public function set_alias($alias){
        $this->alias = $alias;
    }

    public function set_modDepasse($mdp){
        $this->motDePasse = $mdp;
    }

    public function set_mdpCrypte($mdpCrypte){
        $this->mdpCrypte = $mdpCrypte;
    }

    public function load_user($id)
    {
        $TDG = JoueurTDG::getInstance();
        $joueur = $TDG->get_all_info_by_id($id);

        if(!$joueur)
        {
            $TDG = null;
            return false;
        }

        $this->idJoueur = $joueur['idJoueur'];
        $this->courriel = $joueur['courriel'];
        $this->alias = $joueur['alias'];
        $this->nom = $joueur['nom'];
        $this->prénom = $joueur['prénom'];
        $this->montantInitial = $joueur['montantInitial'];
        $this->motDePasse = $joueur['motDePasse'];
        $this->isAdmin = $joueur['isAdmin'];

        var_dump($joueur);

        $TDG = null;
        return true;
    }


    public function login($email, $pw){
        $TDG = JoueurTDG::getInstance();
        $id = $TDG->get_id_by_email($email);       

        if(!$this->load_user($id))
        {
            return false;
        }
        if(!password_verify($pw, $this->mdpCrypte))
        {
            return false;
        }
        return true;
    }

    //Register Validation
    public function validate_email_not_exists($email){
        $TDG = JoueurTDG::getInstance();
        $res = $TDG->get_by_email($email);//retourne seulement le email juste de meme lala
        $TDG = null;
        if($res)
        {
            return false;
        }

        return true;
    }

    public function validate_username_not_exists($username){
        $TDG = JoueurTDG::getInstance();
        $res = $TDG->get_by_email($username);//retourne seulement le email juste de meme lala
        $TDG = null;
        if($res)
        {
            return false;
        }

        return true;
    }

    public function register($alias,$prénom,$nom,$email, $pw, $vpw){
        $montantInitial = 500;

        //check is both password are equals
        if(!($pw === $vpw) || empty($pw) || empty($vpw))
        {
            return false;
        }

        //check if email is used
        if(!$this->validate_email_not_exists($email))
        {
            return false;
        }

        //add user to DB
        $TDG = JoueurTDG::getInstance();
        $res = $TDG->add_user($alias,$nom,$prénom,$pw,$email,$montantInitial,$isAdmin=0);
        $TDG = null;
        return true;
    }

    public function update_email_info($email, $newmail){

        //load user infos
        if(!$this->load_user($email))
        {
          return false;
        }

        if(empty($this->id) || empty($newmail)){
          return false;
        }

        //check if email is already used
        if(!$this->validate_email_not_exists($newmail) && $email != $newmail)
        {
            return false;
        }

        $this->email = $newmail;

        $TDG = JoueurTDG::getInstance();
        $res = $TDG->update_info($this->email, $this->username, $this->id);

        if($res){
          $_SESSION["userEmail"] = $this->email;
        }

        $TDG = null;
        return $res;
    }

    public function update_username_info($name,$newUsername,$email){

        //load user infos
        if(!$this->load_user($email))
        {
          return false;
        }

        if(empty($this->id) || empty($newUsername)){
          return false;
        }

        //check if email is already used
        if(!$this->validate_username_not_exists($newUsername) && $name != $newUsername)
        {
            return false;
        }

        $this->username=$newUsername;

        $TDG = JoueurTDG::getInstance();
        $res = $TDG->update_info($this->email, $this->username, $this->id);

        if($res){
          $_SESSION["userName"] = $this->username;
        }

        $TDG = null;
        return $res;
    }

   
    public function update_user_pw($email, $oldpw, $pw, $pwv){

        if(!$this->load_user($email))
        {
          return false;
        }

        if(empty($pw) || $pw != $pwv){
          return false;
        }

        if(!password_verify($oldpw, $this->passwordhash))
        {
            return false;
        }

        $TDG = JoueurTDG::getInstance();
        $NHP = password_hash($pw, PASSWORD_DEFAULT);
        $res = $TDG->update_password($NHP, $this->id);
        $this->passwordhash = $NHP;
        $TDG = null;
        return $res;
    }

    public function display()
    {
        $id = $this->id;
        include "userview.php";//pas le bon path jpense moi la
    }
}
