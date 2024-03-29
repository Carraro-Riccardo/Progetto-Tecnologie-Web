<?php 
/*
session_start();
session_destroy();
header("Location: index.php");*/

session_start();
require_once("./pages_builder.php");
require_once("./db_handler.php");

$page = PageBuilder::build($_SERVER["SCRIPT_NAME"]);

if(isset($_SESSION["user_id"]) && $_SESSION["ruolo"] == "user"){
    PageBuilder::removeAncorLinks($page, "login.php");
    try {
        $db = new Database();
    $abbonamenti_result = $db->getAbbonamentiUtente($_SESSION['user_id']);
        unset($db);
    }catch(Exception $e) {
        header("Location: ./error500.php");
        exit;
    }

    $abbonamenti = "";
    if($abbonamenti_result->num_rows == 0)
        $abbonamenti = "<p class='tabTitle'>Non hai ancora nessun abbonamento.</p>";
    else {
        $abbonamenti = "<table class='esercizio table-abbonamenti' aria-labelledby='caption-tabella-abbonamenti' aria-describedby='descrizione_tabella'>\n";
        $abbonamenti .= "<caption id='caption-tabella-abbonamenti' class='screen-reader-only'>Tabella contenente tutti gli abbonamenti sottoscritti</caption>\n";
        $abbonamenti .= "<thead>\n<tr>\n<th scope='col'>N.</th>\n<th scope='col'>Tipo</th>\n<th scope='col'>In data</th>\n<th scope='col'>Scadenza</th>\n</tr>\n</thead>\n<tbody>\n";
        
        $i = 1;
        while ($row = $abbonamenti_result->fetch_assoc()) {
            $data_stipula = date("d-m-Y", strtotime($row['data_stipula']));
            $data_scadenza = date("d-m-Y", strtotime($row['data_scadenza']));
        
            $abbonamenti .= "<tr>\n<th scope='row'>" . $i . "</th>\n<td>" . htmlspecialchars($row['nome']) . "</td>\n";
            $abbonamenti .= "<td><time datetime='" . $row['data_stipula'] . "'>" . $data_stipula . "</time></td>\n";
            $abbonamenti .= "<td><time datetime='" . $row['data_scadenza'] . "'>" . $data_scadenza . "</time></td>\n</tr>\n";
            $i++;
        }
        $abbonamenti .= "</tbody>\n</table>\n";
        $abbonamenti .= "<span id='descrizione_tabella' class='screen-reader-only'>Tabella contenente tutti gli abbonamenti sottoscritti in ordine cronologico dal più recente</span>\n";
    }

    $page = str_replace("<!--sezione abbonamenti-->", $abbonamenti, $page);

    //prendi abbonamento attualemnte attivo se presente
    try{
        $db = new Database();
        $abbonamento_result = $db->getActiveAbbonamento($_SESSION['user_id']);
        unset($db);

        if($abbonamento_result->num_rows != 0){
            $abbonamento = $abbonamento_result->fetch_assoc();
            $data_scadenza = date("d-m-Y", strtotime($abbonamento['data_scadenza']));
            $page = str_replace("@@no-abbonamenti@@", "", $page);
        }else{
            $page = str_replace("@@no-abbonamenti@@", "<a class='submitBtn' href='./abbonamenti.php'>Scegli l'abbonamento adatto a te!</a>", $page);
        }
    }catch (Exception $e) {
        header("Location: ./error500.php");
        exit;
    }

}else{
    $_SESSION['error'] = "Devi prima effettuare il login.";
    header("Location: login.php");
    exit;
}


if(isset($_SESSION["error"])){
    $page = str_replace("@@error@@", "<p id='error-message'>".$_SESSION["error"]."</p>", $page);
    unset($_SESSION["error"]);
}
else if(isset($_SESSION["success"])){
    $page = str_replace("@@error@@", "<p id='success-message'>".$_SESSION["success"]."</p>", $page);
    unset($_SESSION["success"]);
}else $page = str_replace("@@error@@", "", $page);

echo $page;
?>