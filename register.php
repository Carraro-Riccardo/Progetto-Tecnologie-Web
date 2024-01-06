<?php
session_start();

if(isset($_SESSION["user_id"])){
    header("Location: profile_schede.php");
    exit();
}

$errorMessage = "";
$errorMessage .= isset($_SESSION['error'])? $_SESSION['error'] : "";
unset($_SESSION['error']);

require_once("./pages_builder.php");
$page = PageBuilder::build($_SERVER["SCRIPT_NAME"]);
$page = str_replace("@@logout@@", "", $page);

if($errorMessage == ""){
    $page = str_replace("@@error@@", "", $page);
}else $page = str_replace("@@error@@", "<p id='error-message'>".$errorMessage."</p>", $page);

echo $page;
?>