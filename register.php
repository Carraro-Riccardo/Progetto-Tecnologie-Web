<?php
session_start();

if(isset($_SESSION["user_id"])){
    header("Location: profile_schede.php");
    exit();
}

require_once("./pages_builder.php");
$page = PageBuilder::build($_SERVER["SCRIPT_NAME"]);
$page = str_replace("@@logout@@", "", $page);
echo $page;
?>