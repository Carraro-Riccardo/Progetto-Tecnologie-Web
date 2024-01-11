<?php
session_start();
require_once("./pages_builder.php");
require_once("./db_handler.php");
require_once("server_side_validator.php");

$page = PageBuilder::build($_SERVER["SCRIPT_NAME"]);
if(isset($_SESSION["user_id"])){
    try {
        $db = new Database();
        $dati_result = $db->getDatiUtente($_SESSION['user_id']);
        unset($db);
    }catch(Exception $e) {
        header("Location: ./error500.php");
        exit;
    }
    
    $page = str_replace("@@qrCode@@", "<img class='qr_code' src='qr_generator.php' alt='qr code'/>", $page);
    $page = str_replace("@@username@@", $dati_result["username"], $page);
    $page = str_replace("@@nome@@", $dati_result["nome"], $page);
    $page = str_replace("@@cognome@@", $dati_result["cognome"], $page);
    $page = str_replace("@@email@@", $dati_result["email"], $page);
    $page = str_replace("@@password@@", $dati_result["password"], $page);

}else{
    $_SESSION['error'] = "Necessario effettuare il <span lang='en'>login</span> per accedere alla pagina.";
    header("Location: login.php?error=notloggedin");
    exit;
}

echo $page;
?>