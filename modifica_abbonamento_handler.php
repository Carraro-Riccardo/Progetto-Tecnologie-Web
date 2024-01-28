<?php
session_start();
require_once("./server_side_validator.php");
require_once("./db_handler.php");

if($_SERVER["REQUEST_METHOD"] == "GET"){
    header("Location: ./error500.php");
    exit;
}

if(isset($_SESSION["user_id"]) && $_SESSION["ruolo"] == "admin"){
    $nomeAbbonamento = isset($_POST['nome']) ? $_POST['nome'] : '';
    $durata = isset($_POST['durata']) ? $_POST['durata'] : '';
    $costo = isset($_POST['costo']) ? $_POST['costo'] : '';
    $id = isset($_POST['abbonamento_id']) ? $_POST['abbonamento_id'] : '';

    $nomeAbbonamentoError = checkNome($nomeAbbonamento);
    $durataError = checkDurata($durata);
    $costoError = checkCosto($costo);

    if(!empty($nomeAbbonamentoError) || !empty($durataError) || !empty($costoError)){
        $_SESSION["errorAbbonamenti"] = $nomeAbbonamentoError.$durataError.$costoError;
        header("Location: ./admin_utenti.php#GESTIONE_ABBONAMENTI");
        exit;
    }

    try {
        $db = new Database();
        $db->modificaAbbonamento($id, $nomeAbbonamento, $durata, $costo);
        unset($db);
    }catch(Exception $e) {
        header("Location: ./error500.php");
        exit;
    }

    $_SESSION["successAbbonamenti"] = "Abbonamento modificato con successo.";
    header("Location: ./admin_utenti.php#GESTIONE_ABBONAMENTI");
    exit;

}else{
    unset($_SESSION["user_id"]);
    $_SESSION["error"] = "Non hai i permessi per accedere a questa pagina. Rieffettua il login.";
    header("Location: ./login.php");
    exit;
}

?>