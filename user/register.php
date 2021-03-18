<?php
    /**
     * template de controlleur
     * doit etre modifier selon le contexte
     * ie: y a t'il des params post/get ?
     * 
     */
    //commence la session
    session_start();

    // include le bundle d'utils
    require_once "../utils/utilbundle.php";

    //regarde si la session est valide
    $sess_status = validate_session();

    /**
     * variable qui determine si un login est necessaire
     */
    $required_sess_status = false; 

    // titre de la page 
    $title = "Register";

    /** 
     * module html que la page va contenire 
     * chaque "view" est un bloc de html ou module a afficher
     * les noms devraient etre la path du fichier a partir de la racine du site web
     */
    $view_array = ["views/registerview.php"];

    // include masterpage
    include "../html/masterpage.php";
    
?>
      
     