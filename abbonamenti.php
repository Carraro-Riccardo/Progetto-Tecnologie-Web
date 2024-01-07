<?php
session_start();
require_once("./pages_builder.php");
require_once("./db_handler.php");

$page = PageBuilder::build($_SERVER["SCRIPT_NAME"]);

if(isset($_SESSION["user_id"])){
    $page = str_replace("@@USER@@", $_SESSION['username'], $page);
    $page = str_replace("@@logout@@", "<li><a href='logout.php'><span lang='en'>Log out</span></a></li>", $page);
}

try {
    $db = new Database();
    $abbonamenti_result = $db->getAbbonamenti();
    unset($db);
}catch(Exception $e) {
    header("Location: index.php?error=erroreInterno");
    exit;
}

$abbonamenti = "";
preg_match('/(<!--carta-->).*(<!--fine carta-->)/s', $page, $matches);

while ($abbonamento = $abbonamenti_result->fetch_assoc()) {
    $card = $matches[0];
    $card = str_replace("@@nome-abbonamento@@", $abbonamento["nome"], $card);
    $card = str_replace("@@costo@@", $abbonamento["costo"], $card);
    $card = str_replace("@@durata@@", $abbonamento["durata"], $card);
    $abbonamenti .= $card;
}

$page = preg_replace('/(<!--carta-->).*(<!--fine carta-->)/s', $abbonamenti, $page);
echo $page;
?>