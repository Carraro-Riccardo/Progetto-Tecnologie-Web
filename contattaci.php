<?php
    session_start();
    require_once("./pages_builder.php");
    $page = PageBuilder::build($_SERVER["SCRIPT_NAME"]);
    if (isset($_SESSION["error"])) {
        $page = str_replace("@@error@@", "<p id='error-message'>" . $_SESSION["error"] . "</p>", $page);
        unset($_SESSION["error"]);
    } else if (isset($_SESSION["success"])) {
        $page = str_replace("@@error@@", "<p id='success-message'>" . $_SESSION["success"] . "</p>", $page);
        unset($_SESSION["success"]);
    } else {
        $page = str_replace("@@error@@", "", $page);
    }
    echo $page;
?>