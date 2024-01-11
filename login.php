<?php
session_start();

//implementare logica di login/registrazione
/*$_SESSION["ID_USER"] = 1;
header("Location: index.php");*/
if (isset($_SESSION['user_id'])) {
    header((isset($_SESSION["ruolo"]) && $_SESSION["ruolo"] == "user")? "Location: profile_profilo.php" : "Location: admin_landing.php");
    exit;
}

$errorMessage = "";
$errorMessage .= isset($_SESSION['error'])? $_SESSION['error'] : "";
unset($_SESSION['error']);

require_once("./pages_builder.php");
$page = PageBuilder::build($_SERVER["SCRIPT_NAME"]);
$page = str_replace("@@logout@@", "", $page);
$page = str_replace("@@USER@@", "Login/Register", $page);

if($errorMessage == ""){
    $page = str_replace("@@error@@", "", $page);
}else $page = str_replace("@@error@@", "<p id='error-message'>".$errorMessage."</p>", $page);

echo $page;


?>