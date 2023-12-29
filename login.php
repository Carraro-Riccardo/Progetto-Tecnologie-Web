<?php
session_start();

//implementare logica di login/registrazione
/*$_SESSION["ID_USER"] = 1;
header("Location: index.php");*/

require_once("./pages_builder.php");
$page = PageBuilder::build($_SERVER["SCRIPT_NAME"]);

echo $page;


?>