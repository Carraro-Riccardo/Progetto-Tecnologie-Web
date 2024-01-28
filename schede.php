<?php
session_start();
require_once("./pages_builder.php");
require_once("./db_handler.php");

function creaTabella($giorni, $esercizi) {
    $tabella = "";
    foreach ($giorni as $giorno) {
        $tabella .= "\n<li>\n\t<table class='esercizio'>\n\t\t<caption>Esercizi " . $giorno . "</caption>\n\t\t<tr>\n\t\t\t<th scope='col'>Esercizio</th>\n\t\t\t<th scope='col'>Set</th>\n\t\t\t<th scope='col'>Ripetizioni</th>\n\t\t</tr>";
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

try {
    $db = new Database();
    $schede_result = $db->getAllSchede();
    unset($db);
}catch(Exception $e) {
    header("Location: ./error500.php");
    exit;
}

$schede = "";
$schede = "<ul class='schede-container'>\n<li>\n";
$curr_scheda = null;
$giorni = array();
$esercizi = array();
$allenatore = ""; // Inizializzazione della variabile $allenatore
while ($row = $schede_result->fetch_assoc()) {
    if ($curr_scheda != $row['id_scheda']) {
        if ($curr_scheda != null) {
            $schede .= "<h2>Scheda " . $curr_scheda . " - Allenatore: " . $allenatore . "</h2>\n<ul class='scheda'>" . creaTabella($giorni, $esercizi) . "\n</ul>\n<a class='submitBtn' href='./aggiungi_scheda_utente.php?id_scheda=".$curr_scheda."'>Aggiungi scheda</a></li>\n<li>\n";
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
$schede .= "\n<h2>Scheda " . $curr_scheda . " - Allenatore: " . $allenatore . "</h2>\n<ul class='scheda'>" . creaTabella($giorni, $esercizi) . "\n</ul><a class='submitBtn' href='./aggiungi_scheda_utente.php?id_scheda=".$curr_scheda."'>Aggiungi scheda</a>\n</li>\n</ul>";

$page = str_replace('<!--sezione schede-->', $schede, $page);

if(isset($_SESSION["error"])){
    $page = str_replace("@@error@@", "<p id='error-message'>".$_SESSION["error"]."</p>", $page);
    unset($_SESSION["error"]);
}else $page = str_replace("@@error@@", "", $page);

echo $page;
?>