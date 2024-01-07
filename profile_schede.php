<?php 
/*
session_start();
session_destroy();
header("Location: index.php");*/

session_start();
require_once("./pages_builder.php");
require_once("./db_handler.php");

function creaTabella($giorni, $esercizi) {
    $tabella = "";
    foreach ($giorni as $giorno) {
        $tabella .= "\n<li>\n\t<table class='esercizio'>\n\t\t<caption>" . $giorno . "</caption>\n\t\t<tr>\n\t\t\t<th scope='col'>Esercizio</th>\n\t\t\t<th scope='col'>Set</th>\n\t\t\t<th scope='col'>Ripetizioni</th>\n\t\t</tr>";
        if (isset($esercizi[$giorno])) {
            foreach ($esercizi[$giorno] as $esercizio) {
                list($nome, $set, $ripetizioni) = explode(", ", $esercizio);
                $tabella .= "\n\t\t<tr>\n\t\t\t<td>" . $nome . "</td>\n\t\t\t<td>" . $set . "</td>\n\t\t\t<td>" . $ripetizioni . "</td>\n\t\t</tr>";
            }
        }
        $tabella .= "\n\t</table>\n</li>";
    }
    return $tabella;
}



$page = PageBuilder::build($_SERVER["SCRIPT_NAME"]);

if(isset($_SESSION["user_id"])){
    $page = str_replace("@@USER@@", $_SESSION['username'], $page);
    $page = str_replace("@@logout@@", "<li><a href='logout.php'><span lang='en'>Log out</span></a></li>", $page);

    try {
        $db = new Database();
        $schede_result = $db->getSchedeUtente($_SESSION['user_id']);
        unset($db);
    }catch(Exception $e) {
        header("Location: login.php?error=sqlerror");
        exit;
    }

    $schede = "";
    if($schede_result->num_rows == 0)
        $schede = "<p class='empty-result'>Non hai ancora nessuna scheda.</p>";
    else {
        $schede = "<ul class='schede-container'>\n<li>\n";
        $curr_scheda = null;
        $giorni = array();
        $esercizi = array();
        $allenatore = ""; // Inizializzazione della variabile $allenatore
        while ($row = $schede_result->fetch_assoc()) {
            if ($curr_scheda != $row['id_scheda']) {
                if ($curr_scheda != null) {
                    $schede .= "<h4 class='intestazione'>Scheda " . $curr_scheda . " - Allenatore: " . $allenatore . "</h4>\n<ul class='scheda'>" . creaTabella($giorni, $esercizi) . "\n</ul>\n";
                    $giorni = array();
                    $esercizi = array();
                }
                $curr_scheda = $row['id_scheda'];
            }
            $allenatore = $row['nome_allenatore']; // Assegnazione del nome dell'allenatore alla variabile $allenatore
            if (!in_array($row['giorno_settimana'], $giorni)) {
                $giorni[] = $row['giorno_settimana'];
            }
            $esercizi[$row['giorno_settimana']][] = $row['nome'] . ", " . $row['numero_set'] . ", " . $row['numero_ripetizioni'];
        }
        $schede .= "</li>\n<li>\n<h4>Scheda " . $curr_scheda . " - Allenatore: " . $allenatore . "</h4>\n<ul class='scheda'>" . creaTabella($giorni, $esercizi) . "</ul>\n</li>\n</ul>";
    }
        
    $page = str_replace("<!--sezione schede-->", $schede, $page);
}else{
    header("Location: login.php?error=notloggedin");
    exit;
}
echo $page;
?>