<?php
session_start();
require_once("./pages_builder.php");
require_once("./db_handler.php");

function creaCardMacchinari($macchinari) {
    $macchinari_cards = "<!--sezione macchinari_start-->
                        <div id=\"cards-container\">
                            <ul>";

    foreach ($macchinari as $row) {
        $macchinari_cards .= "
            <li class=\"card-macchinario " . $row["nomeGruppoMuscolare"] . "\">
                <img src=\"./assets/imgs/macchinari/" . $row["path"] . "\" alt=\"\"/>
                <h3>" . $row["nome"] . "</h3>
                <span class=\"card-macchinario-description\">
                    <p>Data di Acquisto: " . $row["dataDiAcquisto"] . "</p>
                    <p>Gruppo Muscolare: " . $row["nomeGruppoMuscolare"] . "</p>
                </span>
            </li>
            ";
    }

    $macchinari_cards .= "</ul>
                            </div>
                            <!--sezione macchinari_end-->";

    return $macchinari_cards;
}

function popolaGruppiMuscolari($gruppiMuscolari, $selectedMuscleGroup) {
    $gruppiMuscolari_select = "";

    foreach ($gruppiMuscolari as $row) {
        if ($row['gruppoMuscolare'] == $selectedMuscleGroup){
            $gruppiMuscolari_select .= "
                <option value=\"" . $row["gruppoMuscolare"] . "\" selected=\"selected\">" . $row["gruppoMuscolare"] . "</option>
            ";
        } else {
            $gruppiMuscolari_select .= "
                <option value=\"" . $row["gruppoMuscolare"] . "\">" . $row["gruppoMuscolare"] . "</option>
            ";
        }
    }

    $gruppiMuscolari_select .= "</ul>
                            </div>";

    return $gruppiMuscolari_select;
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
    $gruppiMuscolari_result = $db->getAllGruppiMuscolari();
    
    if(isset($_GET["gruppoMuscolare"]))
        $selectedMuscleGroup = $_GET["gruppoMuscolare"];
    else
        $selectedMuscleGroup = "Tutti";
    
    $macchinari_result = $db->getMacchinari($selectedMuscleGroup);
    
    unset($db);
}catch(Exception $e) {
    // TODO: gestire errore
    header("Location: index.php?error=erroreInterno");
    exit;
}

$gruppiMuscolari = popolaGruppiMuscolari($gruppiMuscolari_result, $selectedMuscleGroup);
$page = str_replace('<!--voci gruppi muscolari-->', $gruppiMuscolari, $page);

$tabellaMacchinari = creaCardMacchinari($macchinari_result);

$macchinari_start = strpos($page, "<!--sezione macchinari_start-->");
$macchinari_end = strpos($page, "<!--sezione macchinari_end-->");

$pattern = '/<!--sezione macchinari_start-->(.*?)<!--sezione macchinari_end-->/s';
$page = preg_replace($pattern, $tabellaMacchinari, $page);

echo $page;
?>