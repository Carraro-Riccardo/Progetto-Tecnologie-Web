<?php

require_once("./pages_builder.php");
$page = PageBuilder::build($_SERVER["SCRIPT_NAME"]);
$page = str_replace("@@logout@@", "", $page);
echo $page;

?>