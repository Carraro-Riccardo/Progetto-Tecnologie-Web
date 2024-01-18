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
        $page = str_replace("@@aggiorna_carica@@", "Carica", $page); 
        $page = preg_replace('/(<!--tabella certificato-->).*(<!--fine tabella certificato-->)/s', "<p class='empty-result'>Non hai ancora caricato nessun certificato.</p>", $page);
    }else {
        //$page = preg_replace('/(<!--form caricamento certificato-->).*(<!--fine form caricamento certificato-->)/s', "", $page);
        $page = str_replace("@@aggiorna_carica@@", "Aggiorna", $page);  
        $page = str_replace("@@fileLink@@", $certificato_result["certificatoPath"], $page);
        $page = str_replace("@@fileName@@", basename($certificato_result["certificatoPath"]), $page);
        $page = str_replace("@@stato@@", $certificato_result["stato"], $page);

        if($certificato_result["stato"] == "approvato")
            $page = str_replace("@@scadenza@@", "<time datetime='".$certificato_result["scadenza"]."'>".$certificato_result["scadenza"]."</time>", $page);
        else $page = str_replace("@@scadenza@@", "da definire", $page);
    }

    if(isset($_SESSION["error"])){
        $page = str_replace("@@error@@", "<p id='error-message'>".$_SESSION["error"]."</p>", $page);
        unset($_SESSION["error"]);
    }
    else if(isset($_SESSION["success"])){
        $page = str_replace("@@error@@", "<p id='success-message'>".$_SESSION["success"]."</p>", $page);
        unset($_SESSION["success"]);
    }else $page = str_replace("@@error@@", "", $page);

}else{
    $_SESSION['error'] = "Devi prima effettuare il login.";
    header("Location: ./login.php");
    exit;
}
echo $page;
?>