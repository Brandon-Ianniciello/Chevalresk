<?php
session_start();

require_once "../utils/utilbundle.php";
require_once "../classes/Items/ItemTDG.php";

//regarde si la session est valide
$sess_status = validate_session();

$title = "Armures";

$view_array = ["views/armuresview.php"];

include "../html/masterpage.php";

?>