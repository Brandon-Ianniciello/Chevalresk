<?php
    session_start();

    require_once __DIR__ . "/../utils/utilbundle.php";

    end_session();

    header("Location: ../user/login.php");

    die();
    






