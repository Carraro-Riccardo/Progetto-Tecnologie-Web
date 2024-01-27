<?php

session_start();
require_once("./db_handler.php");

//utente non loggato
if(!isset($_SESSION["user_id"])){
    $_SESSION["error"] = "Devi aver effettuato l'accesso per accedere a questa pagina.";
    header("Location: ./login.php");
    exit;
}

//scheda non passata come parametro
if(!isset($_GET["id_scheda"])){
    $_SESSION["error"] = "Devi selezionare una scheda da rimuovere.";
    header("Location: ./profile_schede.php");
    exit;
}

//la scheda esiste
if(isset($_GET["id_scheda"])){
    try{
        $db = new Database();
        $scheda_result = $db->getSchedaUtente($_SESSION["user_id"], $_GET["id_scheda"]);
        unset($db);
    }catch(Exception $e){
        header("Location: ./error500.php");
        exit;
    }

    if($scheda_result->num_rows == 0){
        $_SESSION["error"] = "La scheda che vuoi rimuovere non esiste.";
        header("Location: ./profile_schede.php");
        exit;
    }
}

//verifica che la scheda sia assegnata all'utente
try{
    $db = new Database();
    $scheda_result = $db->getSchedaUtente($_SESSION["user_id"], $_GET["id_scheda"]);
    unset($db);

    if($scheda_result->num_rows == 0){
        $_SESSION["error"] = "Sembra che tu stia cercando di rimuovere una scheda che non segui.";
        header("Location: ./profile_schede.php");
        exit;
    }

}catch(Exception $e){
    header("Location: ./error500.php");
    exit;
}

//rimuovo la scheda
try{
    $db = new Database();
    $result = $db->removeSchedaUtente($_SESSION["user_id"], $_GET["id_scheda"]);
    unset($db);
}catch(Exception $e){
    header("Location: ./error500.php");
    exit;
}

$_SESSION["success"] = "Scheda rimossa con successo.";
header("Location: ./profile_schede.php");
exit;
?>