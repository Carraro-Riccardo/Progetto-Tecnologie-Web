<?php
session_start();
require_once("./server_side_validator.php");
require_once("./db_handler.php");

if($_SERVER["REQUEST_METHOD"] == "GET"){
    header("Location: ./error500.php");
    exit;
}

if(isset($_SESSION["user_id"]) && $_SESSION["ruolo"] == "admin"){
    $username = isset($_POST['user_id']) ? $_POST['user_id'] : '';
    $convalida = isset($_POST['dataScadenza']) ? $_POST['dataScadenza'] : '';
    
    $convalida = implode("/", array_reverse(explode("-", $convalida)));

    $usernameError = checkUsername($username);
    $convalidaError = checkDataScadenzaCertificato($convalida);

    if(isset($_POST["user_id"]) && isset($_POST["dataScadenza"]) && empty($usernameError) && empty($convalidaError)){
        try {
            $db = new Database();
            $db->convalidaCertificato($_POST["user_id"], $_POST["dataScadenza"]);
            unset($db);
        }catch(Exception $e) {
            header("Location: ./error500.php");
            exit;
        }
        $_SESSION["successConvalida"] = "Certificato convalidato con successo.";
        header("Location: ./admin_utenti.php");
        exit;
    }else{
        $_SESSION["errorConvalida"] = $usernameError.$convalidaError;
        header("Location: ./admin_utenti.php");
        exit;
    }


}else{
    unset($_SESSION["user_id"]);
    $_SESSION["error"] = "Non hai i permessi per accedere a questa pagina. Rieffettua il login.";
    header("Location: ./login.php");
    exit;
}
?>