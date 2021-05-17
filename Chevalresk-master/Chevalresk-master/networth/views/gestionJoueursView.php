<?php

if (isset($_GET['ErrorMSG'])) {
    $msg_error = $_GET['ErrorMSG'];
    echo "<div class='pt-3 text-danger'>
        <h5>$msg_error</h5>
    </div>";
}

/*Tous les joueurs*/
$TDG = JoueurTDG::getInstance();
$allUsers = $TDG->get_all_users();

$table = "<table class='container'><tr><td style='text-align:center;'><h2>GESTION DES JOUEURS</h2></td></tr></table>";

foreach($allUsers as $joueurs => $j){
    if(isset($j['urlPhotoProfil'])){
        $src = ($j['urlPhotoProfil']);
    }
    else{
        $src = "../img/no_profile_pic.png";
    }

    $table .= "
        <tr>
            <div class='container' style='padding:10px;margin:10px;background-color:grey;'>";
    
    $table .= "
            <td>
                <table class='container'>";
    $table.="       <tr><td>
                            <img class='rounded-circle' style='width:30px;height:30px;' src='". $src ."'>
                            <b>". $j['alias'] ."<b>
                        </td>
                    </tr>";
    $table.="       <tr>
                        <td>
                            <b>Solde</b> :". $j['montantInitial'] ."
                        </td>
                        </tr>
                        <tr>
                        <td style='padding-left:0'>
                            <form method='POST' action='../user.dom/ajusterSolde.dom.php?alias=". $j['alias'] ."'>
                                <input type='number' id='montant' name='montant' placeholder='Ajuster montant...' required autofocus>
                                <button type='submit' class='btn btn-dark'>AJUSTER</button>
                            </form>
                        </td>
                        <td>
                            <a href='../user/inventaire.php?alias=" . $j['alias'] . "'><button class='btn btn-dark' type='submit'>CONSULTER L'INVENTAIRE</button></a>
                        </td>
                    </tr>";
                
    $table .= "
                </table>
            </td>
            </div>
        </tr>"       ;
}

echo $table;
?>