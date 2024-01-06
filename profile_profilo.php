<?php
session_start();
require_once("./pages_builder.php");
require_once("./db_handler.php");

$btnLogout = "<a href='logout.php' id='logout'><span lang='en'>Log out</span></a>";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($_POST['action'] === 'Modifica') {
        $_SESSION['editable'] = true;
        $btnLogout = "";
    } else if ($_POST['action'] === 'Salva') {
        // Save the data here
        // check sulla password
        unset($_SESSION['editable']);
    }
}

$page = PageBuilder::build($_SERVER["SCRIPT_NAME"]);
if(isset($_SESSION["user_id"])){
    $page = str_replace("@@USER@@", $_SESSION['username'], $page);
    $page = str_replace("@@logout@@", "<li><a href='logout.php'><span lang='en'>Log out</span></a></li>", $page);

    try {
        $db = new Database();
        $dati_result = $db->getDatiUtente($_SESSION['user_id']);
        unset($db);
    }catch(Exception $e) {
        header("Location: login.php?error=sqlerror");
        exit;
    }

    $editable = isset($_SESSION["editable"]) ? "" : "readonly";
    $buttonInstruction = isset($_SESSION["editable"]) ? "Salva" : "Modifica";
    $confirmLabel = "";
    $confirmButtons = "";
    $confirmDivEnd = "";
    $passwordChangeForm = "";

    if(isset($_SESSION["editable"]) && $_SESSION["editable"] === true){

        $confirmLabel .= "<label id='lblConfirm' for='oldPassword'>Inserisci la <span lang='en'>password</span> per confermare le modifiche.</label>\n";

        $confirmButtons .= "<div class='confirmButtons'>\n<a class='cancelEdit' href='profile_profilo.php'>Annulla</a>\n";
        $confirmDivEnd .= "</div>\n";

        $passwordChangeForm .= "<form action='profile_profilo.php' method='post' class='form-login-register form-modifica-psw'>\n";
        $passwordChangeForm .= "<fieldset>\n";
        $passwordChangeForm .= "<legend>Modifica password</legend>\n";
        $passwordChangeForm .= "<input type='password' id='oldPassword' name='oldPassword' placeholder='Vecchia password' required {$editable}/>\n";
        $passwordChangeForm .= "<input type='password' id='newPassword' name='newPassword' placeholder='Nuova password' required {$editable}/>\n";
        $passwordChangeForm .= "<input type='password' id='confermaNuovaPsw' name='confermaNuovaPsw' placeholder='Conferma nuova password' required {$editable}/>\n";
        $passwordChangeForm .= "<div class='confirmButtons'>\n<a class='cancelEdit' href='profile_profilo.php'>Annulla</a>\n";
        $passwordChangeForm .= "<input type='submit' name='action' class='submitBtn' value='{$buttonInstruction}' />\n</div>\n</fieldset>\n</form>\n";
    }
    
    $page = str_replace("@@editable@@", $editable, $page);
    $page = str_replace("@@username@@", $dati_result["username"], $page);
    $page = str_replace("@@nome@@", $dati_result["nome"], $page);
    $page = str_replace("@@cognome@@", $dati_result["cognome"], $page);
    $page = str_replace("@@email@@", $dati_result["email"], $page);
    $page = str_replace("@@password@@", $dati_result["password"], $page);
    $page = str_replace("@@confirmLabel@@", $confirmLabel, $page);
    $page = str_replace("@@confirmButtons@@", $confirmButtons, $page);
    $page = str_replace("@@buttonInstruction@@", $buttonInstruction, $page);
    $page = str_replace("@@btnLogout@@", $btnLogout, $page);
    $page = str_replace("@@confirmDivEnd@@", $confirmDivEnd, $page);
    $page = str_replace("@@passwordChangeForm@@", $passwordChangeForm, $page);
}else{
    header("Location: login.php?error=notloggedin");
    exit;
}

echo $page;
unset($_SESSION['editable']);
?>