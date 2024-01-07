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
    $page = str_replace("@@USER@@", $_SESSION['username'], $page);
    $page = str_replace("@@logout@@", "<li><a href='logout.php'><span lang='en'>Log out</span></a></li>", $page);

    try {
        $db = new Database();
        $certificato_result = $db->getCertificatoUtente($_SESSION['user_id']);
        unset($db);
    }catch(Exception $e) {
        header("Location: login.php?error=sqlerror");
        exit;
    }

    if($certificato_result->num_rows == 0){
        $page = preg_replace('/(<!--tabella certificato-->).*(<!--fine tabella certificato-->)/s', "<p class='empty-result'>Non hai ancora caricato nessun certificato.</p>", $page);
    }else {
        $certificato_result = $certificato_result->fetch_assoc();
        $page = str_replace("@@fileLink@@", $certificato_result["certificatoPath"], $page);
        $page = str_replace("@@fileName@@", basename($certificato_result["certificatoPath"]), $page);
        $page = str_replace("@@stato@@", $certificato_result["stato"], $page);
        $page = str_replace("@@scadenza@@", $certificato_result["scadenza"], $page);
    }

}else{
    header("Location: login.php?error=notloggedin");
    exit;
}
echo $page;
?>