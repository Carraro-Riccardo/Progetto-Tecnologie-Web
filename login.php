<?php
session_start();

//implementare logica di login/registrazione
$_SESSION["ID_USER"] = 1;
header("Location: index.php");
?>