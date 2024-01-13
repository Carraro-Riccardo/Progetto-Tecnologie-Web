<?php
session_start();
require_once("./pages_builder.php");
require_once("./db_handler.php");


function creaCardMacchinari($macchinari) {
    $macchinari_cards = "<div id='macchinari-container'>";

    foreach ($macchinari as $row) {
        $macchinari_cards .= "
            <div class='macchinario-card'>
            <h3>" . htmlspecialchars($row['nome']) . "</h3>
            <div class='macchinario-details'>
                <p>Data di Acquisto: " . $row['dataDiAcquisto'] . "</p>
                <p>Gruppo Muscolare: " . htmlspecialchars($row['gruppoMuscolare']) . "</p>
            </div>
            </div>
            ";
    }

    $macchinari_cards .= "</div>";

    return $macchinari_cards;
}

$page = PageBuilder::build($_SERVER["SCRIPT_NAME"]);

if(isset($_SESSION["user_id"])){
    $page = str_replace("@@USER@@", $_SESSION['username'], $page);
    $page = str_replace("@@logout@@", "<li><a href='logout.php'><span lang='en'>Log out</span></a></li>", $page);
}else{
    $page = str_replace("@@USER@@", "Login/Register", $page);
    $page = str_replace("@@logout@@", "", $page);
}

try {
    $db = new Database();
    $macchinari_result = $db->getAllMacchinari();
    unset($db);
}catch(Exception $e) {
    // TODO: gestire errore
    header("Location: index.php?error=erroreInterno");
    exit;
}

$tabellaMacchinari = creaCardMacchinari($macchinari_result);

$page = str_replace('<!--sezione macchinari-->', $tabellaMacchinari, $page);
echo $page;
?>
