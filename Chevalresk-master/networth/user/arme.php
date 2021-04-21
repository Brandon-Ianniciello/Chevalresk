<?php
    session_start();

    require_once "../utils/utilbundle.php";
    require_once "../classes/Items/ItemTDG.php";

    //regarde si la session est valide
    $sess_status = validate_session();

    $title = "Armes";

    $view_array = ["views/armesview.php"];

    include "../html/masterpage.php";
?>