<?php
    session_start();
    require_once("./pages_builder.php");
    $page = PageBuilder::build($_SERVER["SCRIPT_NAME"]);
    if(isset($_SESSION["user_id"])){
        $page = str_replace("login.php", "profile.php", $page);
        $page = str_replace("@@USER@@", "Profilo", $page);
    }
    else {
        $page = str_replace("profile.php", "login.php", $page);
        $page = str_replace("@@USER@@", "Login/Register", $page);
    }
    echo $page;
?>