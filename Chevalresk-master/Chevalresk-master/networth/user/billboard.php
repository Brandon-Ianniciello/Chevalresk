<?php
    session_start();

    require_once "../utils/utilbundle.php";
    require_once "../classes/Items/ItemTDG.php";
    require_once "../classes/Joueur/JoueurTDG.php";

    //regarde si la session est valide
    $sess_status = validate_session();

    $title = "billboard";

    $view_array = ["views/billboardview.php"];

    include "../html/masterpage.php";
?>