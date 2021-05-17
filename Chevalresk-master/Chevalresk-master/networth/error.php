<?php

    if(isset($_GET["ErrorMSG"])){
        $errorMSG = $_GET["ErrorMSG"];
        echo "<h2> Error: </h2>";
        echo "<h4>$errorMSG</h4></br>";
    }
?>
