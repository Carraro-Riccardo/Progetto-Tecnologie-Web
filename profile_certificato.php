<?php 
/*
session_start();
session_destroy();
header("Location: index.php");*/

session_start();
require_once("./pages_builder.php");
require_once("./db_handler.php");

$page = PageBuilder::build($_SERVER["SCRIPT_NAME"]);

if(isset($_SESSION["user_id"])){
    PageBuilder::removeAncorLinks($page, "login.php");
    try {
        $db = new Database();
        $certificato_result = $db->getCertificatoUtente($_SESSION['user_id']);
        unset($db);
    }catch(Exception $e) {
        header("Location: ./error500.php");
        exit;
    }


    $certificato_result = $certificato_result->fetch_assoc();
    if($certificato_result["certificatoPath"] == null){
        $page = preg_replace('/(<!--tabella certificato-->).*(<!--fine tabella certificato-->)/s', "<p class='empty-result'>Non hai ancora caricato nessun certificato.</p>", $page);
    }else {
        $page = str_replace("@@fileLink@@", $certificato_result["certificatoPath"], $page);
        $page = str_replace("@@fileName@@", basename($certificato_result["certificatoPath"]), $page);
        $page = str_replace("@@stato@@", $certificato_result["stato"], $page);
        $page = str_replace("@@scadenza@@", $certificato_result["scadenza"], $page);
    }

}else{
    $_SESSION['error'] = "Devi prima effettuare il login.";
    header("Location: login.php");
    exit;
}
echo $page;
?>