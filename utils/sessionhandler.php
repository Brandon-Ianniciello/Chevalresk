<?php
  /*
    fonction qui "set" toutes les variables de session quand un utilisateur
    ce login.
  */
  function login($uID, $uEmail, $uName){
    $_SESSION["userID"] = $uID ;
    $_SESSION["userEmail"] = $uEmail;
    $_SESSION["userName"] = $uName;
    //Session timeout dans 15 minutes
    $_SESSION["timeOut"] = time() + (60 * 15);
    //renew_timeout
    $_SESSION["innitTimeStamp"] = time();
  }

  /*
    fonction qui valide si la Session est encore valide
  */
  function validate_session(){
    $status;
    // l'usager n'est pas valide si cette variable
    // de session n'est pas definis
    if(!isset($_SESSION["userID"])){
      $status = false;
    }
    // si le timeout est arrivé, la session n'est plus valide
    // on dois donc detruire la session
    else if(time() >= $_SESSION["timeOut"]){
      end_session();
      $status = false;
    }
    // Si la Session est active depuis plus de 30 mins,
    // on change son PHP_sessionID
    // peux aussi etre substituer par session_regenerate_id();
    else if(time() - $_SESSION["innitTimeStamp"] > (60 * 30)){
      $uID = $_SESSION["userID"];
      $uEmail = $_SESSION["userEmail"];
      $uName = $_SESSION["userName"];
      end_session();
      session_start();
      login($uID, $uEmail, $uName);
      $status = true;
    }
    else {
      $_SESSION["timeOut"] = time() + (60 * 15);
      $status = true;
    }
    return $status;
  }

  /*
    fonction qui detruit la session (logout dans la langue de shakespear)
  */
  function end_session(){
    $_SESSION = [];

    if (ini_get("session.use_cookies")) {

      $params = session_get_cookie_params();

      setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
      );

    }

    session_destroy();
  }

?>
