<?php 
/*
session_start();
session_destroy();
header("Location: index.php");*/
session_start();
require_once("./pages_builder.php");
$page = PageBuilder::build($_SERVER["SCRIPT_NAME"]);

echo $page;
echo $_SESSION['user_id'];
?>