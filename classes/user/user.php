<?php
include_once __DIR__ . "/userTDG.php";

class User{

    private $id;
    private $email;
    private $username;
    private $passwordhash;
    private $isAdmin;

    /*
        utile si on utilise un factory pattern
    */
    public function __construct(){
        //$this->id = $id;
        //$this->email = $email;
        //$this->username = $username;
        //$this->password = $password;
        //$this->TDG = new UserTDG;
    }


    //getters
    public function get_id(){
        return $this->id;
    }

    public function get_email(){
        return $this->email;
    }

    public function get_username(){
        return $this->username;
    }

    public function get_password(){
        return $this->passwordhash;
    }


    //setters
    public function set_email($email){
        $this->email = $email;
    }

    public function set_username($username){
        $this->username = $username;
    }

    public function set_password($password){
        $this->passwordhash = $password;
    }


    /*
        Quality of Life methods (Dans la langue de shakespear (ou QOLM pour les intimes))
    */
    public function load_user($email){
        $TDG = UserTDG::getInstance();
        $res = $TDG->get_by_email($email);

        if(!$res)
        {
            $TDG = null;
            return false;
        }

        $this->id = $res['idUser'];
        $this->email = $res['email'];
        $this->username = $res['username'];
        $this->passwordhash = $res['passwordhash'];
        $this->isAdmin = $res['isAdmin'];

        $TDG = null;
        return true;
    }


    //Login Validation
    public function login($email, $pw){

        // Regarde si l'utilisateur existes deja
        if(!$this->load_user($email))
        {
            return false;
        }

        // Regarde si le password est verifiable
        if(!password_verify($pw, $this->passwordhash))
        {
            return false;
        }

        return true;
    }

    //Register Validation
    public function validate_email_not_exists($email){
        $TDG = UserTDG::getInstance();
        $res = $TDG->get_by_email($email);
        $TDG = null;
        if($res)
        {
            return false;
        }

        return true;
    }

    public function validate_username_not_exists($username){
        $TDG = UserTDG::getInstance();
        $res = $TDG->get_by_email($username);
        $TDG = null;
        if($res)
        {
            return false;
        }

        return true;
    }


    public function register($email, $username, $pw, $vpw){

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
        $TDG = UserTDG::getInstance();
        $res = $TDG->add_user($email, $username, password_hash($pw, PASSWORD_DEFAULT));
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

        $TDG = UserTDG::getInstance();
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

        $TDG = UserTDG::getInstance();
        $res = $TDG->update_info($this->email, $this->username, $this->id);

        if($res){
          $_SESSION["userName"] = $this->username;
        }

        $TDG = null;
        return $res;
    }

   
    public function update_user_pw($email, $oldpw, $pw, $pwv){

        //load user infos
        if(!$this->load_user($email))
        {
          return false;
        }

        //check if passed param are valids
        if(empty($pw) || $pw != $pwv){
          return false;
        }

        //verify password
        if(!password_verify($oldpw, $this->passwordhash))
        {
            return false;
        }

        //create TDG and update to new hash
        $TDG = UserTDG::getInstance();
        $NHP = password_hash($pw, PASSWORD_DEFAULT);
        $res = $TDG->update_password($NHP, $this->id);
        $this->passwordhash = $NHP;
        $TDG = null;
        //only return true if update_user_pw returned true
        return $res;
    }

    public static function get_username_by_ID($id){
        $TDG = UserTDG::getInstance();
        $res = $TDG->get_by_id($id);
        $TDG = null;
        return $res["username"];
    }

    public function display()
    {
        //variable local
        $id = $this->id;

        include "userview.php";
    }
}
