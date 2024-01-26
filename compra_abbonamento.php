<?php
    session_start();
    require_once("./pages_builder.php");
    require_once("./db_handler.php");

    $errorMessage = "";
    $errorMessage .= isset($_SESSION['error'])? $_SESSION['error'] : "";
    unset($_SESSION['error']);

    //check if user is logged in

    $page = PageBuilder::build($_SERVER["SCRIPT_NAME"]);
    if($errorMessage != ""){
        $page = str_replace("@@error@@", "<p id='error-message'>".$errorMessage."</p>", $page);
    } 

    if(isset($_SESSION["user_id"])){
        $page = str_replace("@@username@@", $_SESSION["user_id"], $page);
        $page = str_replace("@@editable@@", "readonly", $page);
    }else{
        $page = str_replace("@@username@@", "", $page);
        $page = str_replace("@@editable@@", "", $page);
    }

    if(isset($_GET["abbonamento"])){
        try{
            $db = new Database();
            $abbonamento_result = $db->getInfoAbbonamento($_GET["abbonamento"]);
            unset($db);
        }catch(Exception $e){
            header("Location: ./error500.php");
            exit;
        }

        if($abbonamento_result->num_rows == 0){
            $page = str_replace("@@error@@", "<p id='error-message'>L'abbonamento non esiste. Ritorna alla selezione dell'abbonamento.</p>", $page);
            $page = str_replace("@@nome-abbonamento@@", "", $page);
            $page = preg_replace('/(<!--container abbonamento login-->).*(<!--fine container abbonamento login-->)/s', "", $page);
        }else {
            $page = str_replace("@@error@@", "", $page);
            $abbonamento = $abbonamento_result->fetch_assoc();
            $page = str_replace("@@id-abbonamento@@", $_GET["abbonamento"], $page);
            $page = str_replace("@@nome-abbonamento@@", $abbonamento["nome"], $page);
            $page = str_replace("@@durata@@", $abbonamento["durata"], $page);
            $page = str_replace("@@costo@@", $abbonamento["costo"], $page);
        }
    }

    echo $page;

?>