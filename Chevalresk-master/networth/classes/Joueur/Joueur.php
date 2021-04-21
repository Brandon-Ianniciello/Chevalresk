<?php
include_once __DIR__ . "/JoueurTDG.php";

class Joueur
{
    private $idJoueur;
    private $alias;
    private $nom;
    private $prénom;
    private $mdpCrypte;
    private $courriel;
    private $montantInitial;
    private $isAdmin;
    private $photo;

    /*Constructeur*/
    public function __construct()
    {
    }

    /*Getters*/
    public function get_id()
    {
        return $this->idJoueur;
    }

    public function get_courriel()
    {
        return $this->courriel;
    }

    public function get_alias()
    {
        return $this->alias;
    }

    public function get_mdpCrypte()
    {
        return $this->mdpCrypte;
    }

    public function get_nom()
    {
        return $this->nom;
    }

    public function get_prénom()
    {
        return $this->prénom;
    }

    public function get_montantInitial()
    {
        return $this->montantInitial;
    }

    public function get_isAdmin()
    {
        return $this->isAdmin;
    }

    public function get_photo()
    {
        return $this->photo;
    }

    /*Setters*/
    public function set_courriel($courriel)
    {
        $this->courriel = $courriel;
    }

    public function set_nom($nom)
    {
        $this->nom = $nom;
    }

    public function set_prénom($prénom)
    {
        $this->prénom = $prénom;
    }

    public function set_alias($alias)
    {
        $this->alias = $alias;
    }

    public function set_mdpCrypte($mdpCrypte)
    {
        $this->mdpCrypte = $mdpCrypte;
    }

    public function set_photo($url)
    {
        $this->photo = $url;
    }

    public function set_montantInitial($montant)
    {
        $this->montantInitial = $montant;
    }

    public function load_user($id)
    {
        $TDG = JoueurTDG::getInstance();
        $res = $TDG->get_all_info_by_id($id);
        $joueur = $res[0]; //on prends seulement un joueur à la fois

        $this->idJoueur = $joueur['idJoueur'];
        $this->courriel = $joueur['courriel'];
        $this->alias = $joueur['alias'];
        $this->nom = $joueur['nom'];
        $this->prénom = $joueur['prénom'];
        $this->montantInitial = $joueur['montantInitial'];
        $this->mdpCrypte = $joueur['motDePasse'];
        $this->isAdmin = $joueur['isAdmin'];

        $this->photo = $joueur['urlPhotoProfil'];

        $TDG = null;
        return true;
    }


    public function login($email, $pw)
    {
        $TDG = JoueurTDG::getInstance();
        $res = $TDG->get_id_by_email($email);
        $id = $res['idJoueur'];
        $joueur = $this->load_user($id);

        if (!$joueur) {
            return false;
        }
        if (!password_verify($pw, $this->mdpCrypte)) {
            echo ('le mot de passe correspond pas avec le crypté');
            return false;
        }
        return true;
    }

    public function validate_email_not_exists($email)
    {
        $TDG = JoueurTDG::getInstance();
        $res = $TDG->get_by_email($email); //retourne seulement le email juste de meme lala
        $TDG = null;
        if ($res) {
            return false;
        }

        return true;
    }

    public function validate_username_not_exists($username)
    {
        $TDG = JoueurTDG::getInstance();
        $touslesnoms = $TDG->get_all_userName();

        if (isset($touslesnoms[$username]))
            return false;

        $TDG = null;
        return true;
    }

    public function register($alias, $prénom, $nom, $email, $pw, $vpw)
    {
        $montantInitial = 500;
        $isAdmin = 0; //définit l'admin direct dans la bd

        if (!($pw === $vpw) || empty($pw) || empty($vpw)) {
            echo ("mot de passe invalides");
            return false;
        }
        //crypté le mdp
        else {

            $pw = password_hash($pw, PASSWORD_DEFAULT);
        }

        //check if email is used
        if (!$this->validate_email_not_exists($email)) {
            echo ("email déja use");
            return false;
        }

        //add user to DB
        $TDG = JoueurTDG::getInstance();
        $res = $TDG->add_user($alias, $nom, $prénom, $pw, $email, $montantInitial, $isAdmin);
        $TDG = null;
        return $res;
    }

    public function update_email_info($email, $newmail)
    {

        //get id of user 
        $TDG = JoueurTDG::getInstance();
        $res = $TDG->get_id_by_email($email);

        $id = $res['idJoueur'];

        //load user infos
        if (!$this->load_user($id)) {
            return false;
        }

        if (empty($this->idJoueur) || empty($newmail)) {
            return false;
        }

        //check if email is already used
        if (!$this->validate_email_not_exists($newmail) && $email != $newmail) {
            return false;
        }

        $this->courriel = $newmail;

        $TDG = JoueurTDG::getInstance();
        $res = $TDG->update_email($this->courriel, $this->idJoueur);

        if ($res) {
            $_SESSION["userEmail"] = $this->courriel;
        }

        $TDG = null;
        return $res;
    }

    public function update_username_info($name, $newUsername, $idJoueur)
    {

        //load user infos
        if (!$this->load_user($idJoueur)) {
            return false;
        }

        //check if username is already used
        if (!$this->validate_username_not_exists($newUsername) && $name != $newUsername) {
            return false;
        }

        $this->alias = $newUsername;

        $TDG = JoueurTDG::getInstance();
        $res = $TDG->update_username($this->alias, $this->idJoueur);

        if ($res) {
            $_SESSION["userName"] = $this->alias;
        }

        $TDG = null;
        return $res;
    }

    public function update_user_pw($id, $oldpw, $pw, $pwv)
    {

        if (!$this->load_user($id)) {
            return false;
        }

        if (empty($pw) || $pw != $pwv) {
            return false;
        }

        if (!password_verify($oldpw, $this->mdpCrypte)) {
            return false;
        }

        $TDG = JoueurTDG::getInstance();
        $NHP = password_hash($pw, PASSWORD_DEFAULT);
        $res = $TDG->update_password($NHP, $this->idJoueur);
        $this->set_mdpCrypte($NHP);
        $TDG = null;
        return $res;
    }

    public function update_user_montant($montant, $alias)
    {
        $TDG = JoueurTDG::getInstance();
        $res = $TDG->update_montant_joueur($montant,$alias);
        $this->montantInitial = $montant;
        $TDG = null;
        return $res;
    }

}
