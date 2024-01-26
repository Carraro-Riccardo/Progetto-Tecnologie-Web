<?php
session_start();
require_once("./server_side_validator.php");
require_once("./db_handler.php");

$username = isset($_POST['username']) ? $_POST['username'] : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';

$abbonamento = isset($_POST['abbonamento']) ? $_POST['abbonamento'] : '';
$cardNumber = isset($_POST['cardNumber']) ? $_POST['cardNumber'] : '';
$dataScadenza = isset($_POST['dataScadenza']) ? $_POST['dataScadenza'] : '';
$cvv = isset($_POST['cvv']) ? $_POST['cvv'] : '';



$usernameError = checkUsername($username);
$usernameError = checkPassword($password);

/* TODO
$abbonamentoError = checkAbbonamento($abbonamento);
$cardNumberError = checkCardNumber($cardNumber);
$dataScadenzaError = checkDataScadenza($dataScadenza);
$cvvError = checkCvv($cvv);
*/

if (!empty($usernameError)) {
    $_SESSION["error"] = $usernameError . $passwordError;
    header("Location: ./register.php");
    exit();
}

$login_result = "";
try {
    $db = new Database();
    $login_result = $db->login($username, $password);
    unset($db);
}catch(Exception $e) {
    unset($db);
    header("Location: ./error500.php");
    exit;
}


//Check se l'utente ha inserito le credenziali corrette
if($login_result){
    $_SESSION['user_id'] = $login_result['username'];
    $_SESSION['ruolo'] = $login_result['ruolo'];
} else {
    $_SESSION["error"] = "Credenziali errate. PASSW:".$password." USERN:".$username. "abbonamento:".$abbonamento." cardNumber:".$cardNumber." dataScadenza:".$dataScadenza." cvv:".$cvv;
    header("Location: ./compra_abbonamento.php?abbonamento=".$abbonamento); 
    exit;
}

//check se l'abbonamento davvero esiste
try{
    $db = new Database();
    $abbonamento_result = $db->getInfoAbbonamento($abbonamento);
    unset($db);

    if($abbonamento_result->num_rows == 0){
        $_SESSION["error"] = "L'abbonamento non esiste. Ritorna alla selezione dell'abbonamento.";
        header("Location: ./compra_abbonamento.php?abbonamento=".$abbonamento);
        exit;
    }
}catch(Exception $e){
    unset($db);
    header("Location: ./error500.php");
    exit;
}


//check se l'utente ha già un abbonamento attivo
try{
    $db = new Database();
    $abbonamento_result = $db->getActiveAbbonamento($_SESSION['user_id']);
    unset($db);

    if($abbonamento_result->num_rows != 0){
        $_SESSION["error"] = "Hai già un abbonamento attivo. Ritorna alla selezione dell'abbonamento.";
        header("Location: ./compra_abbonamento.php?abbonamento=".$abbonamento);
        exit;
    }
}catch(Exception $e){
    unset($db);
    header("Location: ./error500.php");
    exit;
}

//attiviamo l'abbonamento all'utente
try{
    $db = new Database();
    $abbonamento_result = $db->attivaAbbonamento($_SESSION['user_id'], $abbonamento);
    unset($db);
}catch(Exception $e){
    unset($db);
    header("Location: ./error500.php");
    exit;
}
?>