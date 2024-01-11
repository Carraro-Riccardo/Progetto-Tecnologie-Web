<?php
session_start();

if (isset($_SESSION['user_id'])) {
    header((isset($_SESSION["ruolo"]) && $_SESSION["ruolo"] == "user")? "Location: ./profile_profilo.php" : "Location: ./admin_landing.php");
    exit;
}

$errorMessage = "";
$errorMessage .= isset($_SESSION['error'])? $_SESSION['error'] : "";
unset($_SESSION['error']);

require_once("./pages_builder.php");
$page = PageBuilder::build($_SERVER["SCRIPT_NAME"]);
if($errorMessage == ""){
    $page = str_replace("@@error@@", "", $page);
}else $page = str_replace("@@error@@", "<p id='error-message'>".$errorMessage."</p>", $page);

echo $page;


?>