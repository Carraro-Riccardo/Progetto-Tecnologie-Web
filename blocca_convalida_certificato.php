<?php
session_start();
require_once("./db_handler.php");

if(isset($_GET["user_id"])){
    try {
        $db = new Database();
        $db->bloccaCertificatoUtente($_GET["user_id"]);
        unset($db);
    }catch(Exception $e) {
        header("Location: ./error500.php");
        exit;
    }

    $_SESSION["successConvalida"] = "Blocco della convalida del certificato avvenuto correttamente.";
    header("Location: ./admin_amministrazione.php#GESTIONE_CERTIFICATI");
    exit;
}else{
    header("Location: ./error500.php");
    exit;
}

?>