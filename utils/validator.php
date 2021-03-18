<?php

    function validate_email($email)
    {
        if(empty($email))
        {
            return false;
        }

        $reg="/^([0-9a-zA-Z]([-\.\w]*[0-9a-zA-Z])*@([0-9a-zA-Z][-\w]*[0-9a-zA-Z]\.)+[a-zA-Z]{2,9})$/";
        
        if(preg_match_all($reg, $email))
        {
            return true;
        }
        return false;
    }

    function validate_password($password)
    {
        if(empty($password))
        {
            return false;
        }

        $reg1="/[a-z]+/";
        $reg2="/[A-Z]+/";
        $reg3="/[0-9]+/";
        $reg4="/[!@#$%^&*(){}+=|\/?.]+/";
        $reg5 = "/[\s]/";

        //toutes les conditions (si true == condition de fail)
        switch(true){
            case(!preg_match($reg1,$password)):
                return false;
            case(!preg_match($reg2,$password)):
                return false;
            case(!preg_match($reg3,$password)):
                return false;
            case(!preg_match($reg4,$password)):
                return false;
            case(preg_match($reg5,$password)):
                return false;
            case(strlen($password) < 8):
                return false;
        }

        //si toutes les conditions de fail ne sont pas satisfaite, retourn true (le password est valide)
        return true;
    }

    function validate_param($arr, $required_post){

        foreach($required_post as $post){
            if(!isset($arr[$post])){
                http_response_code(400);
                echo ("error 400: bad request");
                die();
            }
        }

    }

    function sanitize($param){
        $param = stripslashes($param);
        $param = htmlentities($param);
        $param = strip_tags($param);
        return $param;
    }
?>
