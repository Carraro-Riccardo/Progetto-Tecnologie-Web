<?php
session_start();
require_once("./pages_builder.php");
require_once("./db_handler.php");
require_once("server_side_validator.php");

$errorMessageUserData = "";
$errorMessagePasswordChange = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    if ($_POST['action'] === 'Salva') {

        $username = $_POST['username']? $_POST['username'] : "";
        $nome = $_POST['nome']? $_POST['nome'] : "";
        $cognome = $_POST['cognome']? $_POST['cognome'] : "";
        $email = $_POST['email']? $_POST['email'] : "";
        $password = $_POST['password']? $_POST['password'] : "";

        $usernameError = checkUsername($username);
        $nomeError = checkNome($nome);
        $cognomeError = checkCognome($cognome);
        $emailError = checkEmail($email);
        $passwordError = checkPassword($password);

        if (!empty($usernameError) || !empty($nomeError) || !empty($cognomeError) || !empty($emailError) || !empty($passwordError)) {
            $errorMessageUserData = "<p id='error-message'>".$usernameError . $nomeError . $cognomeError . $emailError . $passwordError ."</p>";
        }

        //logica di salvataggio

    } else if ($_POST['action'] === "Salva password"){
        $oldPassword = $_POST['oldPassword']? $_POST['oldPassword'] : "";
        $newPassword = $_POST['newPassword']? $_POST['newPassword'] : "";
        $confermaNuovaPsw = $_POST['confermaNuovaPsw']? $_POST['confermaNuovaPsw'] : "";

        $oldPasswordError = checkPassword($oldPassword);
        $newPasswordError = checkRegisterPassword($newPassword, $confermaNuovaPsw);

        if (!empty($oldPasswordError) || !empty($newPasswordError)) {
            $errorMessagePasswordChange = "<p id='error-message'>".$oldPasswordError . $newPasswordError ."</p>";
        }

        //logica di salvataggio
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
        $_SESSION['error'] = "Errore interno.";
        header("Location: login.php?error=sqlerror");
        exit;
    }
    
    $page = str_replace("@@errorMessageUserData@@", $errorMessageUserData, $page);
    $page = str_replace("@@errorMessagePasswordChange@@", $errorMessagePasswordChange, $page);
    $page = str_replace("@@username@@", $dati_result["username"], $page);
    $page = str_replace("@@nome@@", $dati_result["nome"], $page);
    $page = str_replace("@@cognome@@", $dati_result["cognome"], $page);
    $page = str_replace("@@email@@", $dati_result["email"], $page);


}else{
    $_SESSION['error'] = "Necessario effettuare il <span lang='en'>login</span> per accedere alla pagina.";
    header("Location: login.php?error=notloggedin");
    exit;
}

echo $page;
?>