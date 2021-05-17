<?php
    session_start();

    require_once "../utils/utilbundle.php";
    require_once "../classes/Items/ItemTDG.php";

    //regarde si la session est valide
    $sess_status = validate_session();

    $title = "Potions";

    $view_array = ["views/ressourcesView.php"];

    include "../html/masterpage.php";
?>