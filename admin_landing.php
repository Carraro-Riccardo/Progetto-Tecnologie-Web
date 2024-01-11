<?php
session_start();
require_once("./pages_builder.php");
require_once("./db_handler.php");

if(isset($_SESSION["ruolo"]) && $_SESSION["ruolo"] != "admin"){
    unset($_SESSION["user_id"]);
    $_SESSION["error"] = "Non hai i permessi per accedere a questa pagina. Rieffettua il login.";
    header("Location: login.php");
    exit();
}

$page = PageBuilder::build($_SERVER["SCRIPT_NAME"]);
if(isset($_SESSION["ruolo"]) && $_SESSION["ruolo"] == "admin"){
    $page = str_replace("@@USER@@", "Gestione Profilo", $page); //TODO profilo dedicato all'admin
    $page = str_replace("@@logout@@", "<li><a href='logout.php'><span lang='en'>Log out</span></a></li>", $page);
}

$abbonamenti_validi = "";
$incassi = "";
$certificati = "";
$utenti = "";

$andamentoIncassi = "";
$andamentoUtenti = "";

try {
    $db = new Database();
    $abbonamenti_validi = $db->getNumeroAbbonatiValidi();
    $incassi = $db->getIncassi();
    $certificati = $db->getCertificatiDaValidare();
    $utenti = $db->getTotaleUtenti();

    
    $andamentoIncassi = $db->getAndamentoIncassi();
    $andamentoIncassi = "<img src='./graph_generator.php?graph_data=".urlencode(json_encode($andamentoIncassi))."' alt='Andamento incassi' />";
    $andamentoUtenti = $db->getAndamentoUtenti();
    $andamentoUtenti = "<img src='./graph_generator.php?graph_data=".urlencode(json_encode($andamentoUtenti))."' alt='Andamento utenti' />";
    
    unset($db);
}catch(Exception $e) {
    unset($_SESSION["user_id"]);
    header("Location: ./error500.php");
    exit;
}

$page = str_replace("@@nAbbVal@@", $abbonamenti_validi, $page);
$page = str_replace("@@incassi@@", $incassi, $page);
$page = str_replace("@@certificati@@", $certificati, $page);
$page = str_replace("@@utenti@@", $utenti, $page);
$page = str_replace("@@graficoIncassi@@", $andamentoIncassi, $page);
$page = str_replace("@@graficoUtenti@@", $andamentoUtenti, $page);
echo $page;
?>