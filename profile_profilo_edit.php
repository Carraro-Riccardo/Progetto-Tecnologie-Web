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
        }else{

            //try login
            try {
                $db = new Database();
                $login_result = $db->login($_SESSION["user_id"], $password);
                unset($db);
            }catch(Exception $e) {
                unset($db);
                header("Location: ./error500.php");
                exit;
            }

            if(!$login_result){
                $errorMessageUserData = "<p id='error-message'><span lang='en'>Password</span> errata.</p>";
            }else{
                //logica di salvataggio
                if($_SESSION["user_id"] != $username){
                    try {
                        $db = new Database();
                        $result = $db->checkUsername($username);
                        unset($db);
                    }catch(Exception $e) {
                        unset($db);
                        header("Location: ./error500.php");
                        exit;
                    }
                    if($result->num_rows > 0){
                        $errorMessageUserData = "<p id='error-message'><span lang='en'>Username</span> già in uso.</p>";
                    }else{
                        try {
                            $db = new Database();
                            $result = $db->updateUsernameUtente($_SESSION["user_id"], $username);
                            unset($db);
                        }catch(Exception $e) {
                            unset($db);
                            header("Location: ./error500.php");
                            exit;
                        }
                        $_SESSION["user_id"] = $username;
                    }
                }
        
                //update parameters
                if(empty($errorMessageUserData)){
                    try {
                        $db = new Database();
                        $result = $db->updateUserData($_SESSION["user_id"], $nome, $cognome, $email);
                        unset($db);
                    }catch(Exception $e) {
                        unset($db);
                        header("Location: ./error500.php");
                        exit;
                    }
                    
                    $_SESSION["success"] = "Dati aggiornati con successo.";
                    header("Location: ./profile_profilo.php");
                    exit;
                }
            }

        }


    } else if ($_POST['action'] === "Salva password"){
        $oldPassword = $_POST['oldPassword']? $_POST['oldPassword'] : "";
        $newPassword = $_POST['newPassword']? $_POST['newPassword'] : "";
        $confermaNuovaPsw = $_POST['confermaNuovaPsw']? $_POST['confermaNuovaPsw'] : "";

        $oldPasswordError = checkPassword($oldPassword);
        $newPasswordError = checkRegisterPassword($newPassword, $confermaNuovaPsw);

        if (!empty($oldPasswordError) || !empty($newPasswordError)) {
            $errorMessagePasswordChange = "<p id='error-message'>".$oldPasswordError . $newPasswordError ."</p>";
        }else {
            
            try {
                $db = new Database();
                $result = $db->login($_SESSION["user_id"], $oldPassword);
                unset($db);
                
                if(empty($result)){
                    $errorMessagePasswordChange = "<p id='error-message'><span lang='en'>Password</span> errata.</p>";
                }else{
                    try {
                        $db = new Database();
                        $result = $db->updatePasswordUtente($_SESSION["user_id"], $newPassword);
                        unset($db);
                    }catch(Exception $e) {
                        header("Location: ./error500.php");
                        exit;
                    }

                    $_SESSION["success"] = "<span lang='en'>Password</span> aggiornata con successo";
                    header("Location: ./profile_profilo.php");
                    exit;
                }
            
            }catch(Exception $e) {
                header("Location: ./error500.php");
                exit;
            }
        }
    }
}

$page = PageBuilder::build($_SERVER["SCRIPT_NAME"]);
if(isset($_SESSION["user_id"]) && $_SESSION["ruolo"] == "user"){
    PageBuilder::removeAncorLinks($page, "login.php");
    try {
        $db = new Database();
    $dati_result = $db->getDatiUtente($_SESSION['user_id']);
        unset($db);
    }catch(Exception $e) {
        header("Location: ./error500.php");
        exit;
    }
    
    $page = str_replace("@@errorMessageUserData@@", $errorMessageUserData, $page);
    $page = str_replace("@@errorMessagePasswordChange@@", $errorMessagePasswordChange, $page);
    $page = str_replace("@@username@@", $dati_result["username"], $page);
    $page = str_replace("@@nome@@", $dati_result["nome"], $page);
    $page = str_replace("@@cognome@@", $dati_result["cognome"], $page);
    $page = str_replace("@@email@@", $dati_result["email"], $page);
    $page = str_replace("@@password@@", "", $page);

    unset($_SESSION["error"]);

} else if (isset($_SESSION['user_id']) && $_SESSION["ruolo"] == "admin") {
    header("Location: ./admin_landing.php");
    exit;
} else{
    $_SESSION['error'] = "Necessario effettuare il <span lang='en'>log in</span> per accedere alla pagina.";
    header("Location: ./login.php");
    exit;
}

echo $page;
?>