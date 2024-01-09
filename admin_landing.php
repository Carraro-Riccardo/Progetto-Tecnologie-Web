<?php
session_start();

if(isset($_SESSION["ruolo"]) && $_SESSION["ruolo"] != "admin"){
    unset($_SESSION["user_id"]);
    $_SESSION["error"] = "Non hai i permessi per accedere a questa pagina. Rieffettua il login.";
    header("Location: login.php");
    exit();
}

require_once("./pages_builder.php");
$page = PageBuilder::build($_SERVER["SCRIPT_NAME"]);
if(isset($_SESSION["ruolo"]) && $_SESSION["ruolo"] == "admin"){
    $page = str_replace("@@USER@@", "Gestione Profilo", $page); //TODO profilo dedicato all'admin
    $page = str_replace("@@logout@@", "<li><a href='logout.php'><span lang='en'>Log out</span></a></li>", $page);
}
$page = str_replace("@@logout@@", "", $page);

echo $page;
?>