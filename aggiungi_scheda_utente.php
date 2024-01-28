<?php

session_start();
require_once("./db_handler.php");

if(!isset($_GET["id_scheda"])){
    header("Location: ./schede.php");
    exit;
} 

//check if scheda exists
try {
    $db = new Database();
    $scheda_result = $db->getScheda($_GET["id_scheda"]);
    unset($db);

    if($scheda_result->num_rows == 0){
        $_SESSION["error"] = "La scheda indicata non esiste";
        header("Location: ./schede.php");
        exit;
    }

}catch(Exception $e){
    header("Location: ./error500.php");
    exit;
}

//richiedo per forza il login per seguire una scheda
if(!isset($_SESSION["user_id"])){
    $_SESSION["error"] = "Devi essere loggato per poter aggiungere una scheda";
    $_SESSION["redirect_to"] = "./".basename($_SERVER["SCRIPT_NAME"])."?id_scheda=".$_GET["id_scheda"];
    header("Location: ./login.php");
    exit;
}

//aggiungo la scheda all'utente
try {
    $db = new Database();
    $scheda_result = $db->addSchedaUtente($_SESSION["user_id"], $_GET["id_scheda"]);
    unset($db);

    $_SESSION["success"] = "Scheda aggiunta con successo";
    header("Location: ./profile_schede.php");
    exit;
}catch(Exception $e){
    unset($db);
    header("Location: ./error500.php");
    exit;
}

?>