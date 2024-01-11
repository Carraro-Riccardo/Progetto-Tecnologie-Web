<?php 
/*
session_start();
session_destroy();
header("Location: index.php");*/

session_start();
require_once("./pages_builder.php");
require_once("./db_handler.php");

$page = PageBuilder::build($_SERVER["SCRIPT_NAME"]);

if(isset($_SESSION["user_id"])){
    $page = str_replace("@@USER@@", $_SESSION['username'], $page);
    $page = str_replace("@@logout@@", "<li><a href='logout.php'><span lang='en'>Log out</span></a></li>", $page);

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
        $abbonamenti = "<p class='empty-result'>Non hai ancora nessun abbonamento.</p>";
    else {
        $abbonamenti = "<table class='esercizio table-abbonamenti' aria-labelledby='caption-tabella-abbonamenti'>\n";
        $abbonamenti .= "<caption id='caption-tabella-abbonamenti' class='caption-nascosta'>Tabella contenente tutti gli abbonamenti sottoscritti</caption>\n";
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
    }

    $page = str_replace("<!--sezione abbonamenti-->", $abbonamenti, $page);
}else{
    $_SESSION['error'] = "Devi prima effettuare il login.";
    header("Location: login.php");
    exit;
}
echo $page;
?>