<?php
    require_once("./pages_builder.php");
    $page = PageBuilder::build($_SERVER["SCRIPT_NAME"]);
    echo $page;
?>