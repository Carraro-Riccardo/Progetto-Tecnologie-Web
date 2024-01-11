<?php

session_start();
session_destroy();
require_once("./pages_builder.php");
$page = PageBuilder::build($_SERVER["SCRIPT_NAME"]);
if(isset($_SESSION["user_id"])){
    //$page = str_replace("login.php", "profile_schede.php", $page);
    $page = str_replace("@@USER@@", "Profilo", $page);
    $page = str_replace("@@logout@@", "<li><a href='logout.php'><span lang='en'>Log out</span></a></li>", $page);
}
else {
    $page = str_replace("profile.php", "login.php", $page);
    $page = str_replace("@@USER@@", "Login/Register", $page);
    $page = str_replace("@@logout@@", "", $page);
}
echo $page;

?>