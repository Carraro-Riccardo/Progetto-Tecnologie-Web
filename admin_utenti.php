<?php
session_start();
require_once("./pages_builder.php");
require_once("./db_handler.php");

if(isset($_SESSION["ruolo"]) && $_SESSION["ruolo"] == "admin"){
    $page = PageBuilder::build($_SERVER["SCRIPT_NAME"]); 
    PageBuilder::removeAncorLinks($page, "login.php");
    $page = str_replace("@@USER@@", "Gestione Profilo", $page); //TODO profilo dedicato all'admin
    $page = str_replace("@@logout@@", "<li><a href='logout.php'><span lang='en'>Log out</span></a></li>", $page);
    
    $errorMessage = "";
    $errorMessage .= isset($_SESSION['error'])? $_SESSION['error'] : "";
    unset($_SESSION['error']);
    if($errorMessage == ""){
        $page = str_replace("@@error@@", "", $page);
    }else $page = str_replace("@@error@@", "<p id='error-message'>".$errorMessage."</p>", $page);

    $utenti = "";
    try {
        $db = new Database();

        $utenti = $db->getAllusers();
        unset($db);
    }catch(Exception $e) {
        unset($_SESSION["user_id"]);
        header("Location: ./error500.php");
        exit;
    }

    $listItem = "<option>Search User</option>\n";
    $previousLetter = "";

    while ($row = $utenti->fetch_assoc()) {
        $currentLetter = strtoupper(substr($row["username"], 0, 1));

        if ($currentLetter !== $previousLetter) {
            $listItem .= "<option disabled>".$currentLetter."</option>\n";
            $previousLetter = $currentLetter;
        }

        $listItem .= "<option value=\"".$row["username"]."\">".$row["username"]."</option>\n";
    }

    if(isset($_POST["utente"])){
        foreach ($utenti as $utente) {
            if($utente["username"] == $_POST["utente"]){
                $page = str_replace("@@username@@", $utente["username"], $page);
                $page = str_replace("@@nome@@", $utente["nome"], $page);
                $page = str_replace("@@cognome@@", $utente["cognome"], $page);
                $page = str_replace("@@email@@", $utente["email"], $page);
                $page = str_replace("@@certificato@@", $utente["certificatoPath"], $page);
                $page = str_replace("@@id@@", $utente["id"], $page);
                break;
            }
        }
    }else{
        $page = preg_replace('/(<!--form utente-->).*(<!--fine form utente-->)/s', "<p class='empty-result'>Seleziona un utente.</p>", $page);
    }

    $page = str_replace("@@lista-utenti@@", $listItem, $page);
    echo $page;
}else{
    unset($_SESSION["user_id"]);
    $_SESSION["error"] = "Non hai i permessi per accedere a questa pagina. Rieffettua il login.";
    header("Location: login.php");
    exit();
}
?>