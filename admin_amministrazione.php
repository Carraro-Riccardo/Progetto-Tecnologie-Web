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


    /********************/
    /*  GESTIONE UTENTI */
    /********************/
    $utenti = "";
    try {
        $db = new Database();

        $utenti = $db->getUserCertificateToBeValidated();
        //username, nome, cognome, email, certificatoPath
        unset($db);
    }catch(Exception $e) {
        unset($_SESSION["user_id"]);
        header("Location: ./error500.php");
        exit;
    }

    if($utenti->num_rows == 0){
        $page = preg_replace('/(<!--tabella certificati-->).*(<!--fine tabella certificati-->)/s', "<p class='empty-result'>Non ci sono utenti da validare.</p>", $page);
    }else{
        $utentiList = "";
        preg_match('/(<!--user data-->).*(<!--fine user data-->)/s', $page, $matches);
        while ($row = $utenti->fetch_assoc()) {
            $user = $matches[0];
            $user = str_replace("@@username@@", $row["username"], $user);
            $user = str_replace("@@nome@@", $row["nome"], $user);
            $user = str_replace("@@cognome@@", $row["cognome"], $user);
            $user = str_replace("@@certificatoPath@@", $row["certificatoPath"], $user);
            $utentiList .= $user;
        }
    }
    $page = preg_replace('/(<!--user data-->).*(<!--fine user data-->)/s', $utentiList, $page);


    /************************/
    /*  GESTIONE ABBONAMENTI */
    /************************/
    $abbonamenti = "";
    try {
        $db = new Database();

        $abbonamenti = $db->getAbbonamenti();
        //id, nome, durata, costo
        unset($db);
    }catch(Exception $e) {
        unset($_SESSION["user_id"]);
        header("Location: ./error500.php");
        exit;
    }

    if($abbonamenti->num_rows == 0){
        $page = preg_replace('/(<!--tabella abbonamenti-->).*(<!--fine tabella abbonamenti-->)/s', "<p class='empty-result'>Non ci sono abbonamenti.</p>", $page);
    }else{
        $abbonamentiList = "";
        preg_match('/(<!--dati abbonamento-->).*(<!--fine dati abbonamento-->)/s', $page, $matches);
        while ($row = $abbonamenti->fetch_assoc()) {
            $abbonamento = $matches[0];
            $abbonamento = str_replace("@@abbonamento@@", $row["nome"], $abbonamento);
            $abbonamento = str_replace("@@durata@@", $row["durata"], $abbonamento);
            $abbonamento = str_replace("@@prezzo@@", $row["costo"], $abbonamento);
            $abbonamento = str_replace("@@abbonamento_id@@", $row["id"], $abbonamento);
            $abbonamentiList .= $abbonamento;
        }
    }
    $page = preg_replace('/(<!--dati abbonamento-->).*(<!--fine dati abbonamento-->)/s', $abbonamentiList, $page);




    if(isset($_SESSION["errorConvalida"])){
        $page = str_replace("@@errorConvalida@@", "<p id='error-message'>".$_SESSION["errorConvalida"]."</p>", $page);
        unset($_SESSION["errorConvalida"]);
    }
    else if(isset($_SESSION["successConvalida"])){
        $page = str_replace("@@errorConvalida@@", "<p id='success-message'>".$_SESSION["successConvalida"]."</p>", $page);
        unset($_SESSION["successConvalida"]);
    }
    else $page = str_replace("@@errorConvalida@@", "", $page);

    if(isset($_SESSION["errorAbbonamenti"])){
        $page = str_replace("@@errorAbbonamenti@@", "<p id='error-message'>".$_SESSION["errorAbbonamenti"]."</p>", $page);
        unset($_SESSION["errorAbbonamenti"]);
    }
    else if(isset($_SESSION["successAbbonamenti"])){
        $page = str_replace("@@errorAbbonamenti@@", "<p id='success-message'>".$_SESSION["successAbbonamenti"]."</p>", $page);
        unset($_SESSION["successAbbonamenti"]);
    }
    else $page = str_replace("@@errorAbbonamenti@@", "", $page);

    echo $page;
}else{
    unset($_SESSION["user_id"]);
    $_SESSION["error"] = "Non hai i permessi per accedere a questa pagina. Rieffettua il login.";
    header("Location: login.php");
    exit();
}
?>