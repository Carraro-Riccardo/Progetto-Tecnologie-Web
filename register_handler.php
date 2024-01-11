<?php
session_start();
require_once("db_handler.php");
require_once("server_side_validator.php");

if (isset($_SESSION['user_id'])) {
    header("Location: profile.php");
    exit;
}

$username = isset($_POST['username']) ? $_POST['username'] : '';
$nome = isset($_POST['nome']) ? $_POST['nome'] : '';
$cognome = isset($_POST['cognome']) ? $_POST['cognome'] : '';
$email = isset($_POST['email']) ? $_POST['email'] : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';
$confirmPassword = isset($_POST['confirmPassword']) ? $_POST['confirmPassword'] : '';

$usernameError = checkUsername($username);
$nomeError = checkNome($nome);
$cognomeError = checkCognome($cognome);
$emailError = checkEmail($email);
$passwordError = checkRegisterPassword($password, $confirmPassword);

if (!empty($usernameError) || !empty($nomeError) || !empty($cognomeError) || !empty($emailError) || !empty($passwordError)) {
    $_SESSION["error"] = $usernameError . $nomeError . $cognomeError . $emailError . $passwordError;
    header("Location: register.php");
    exit();
}

try {
    $db = new Database();
    $register_result = $db->register($username, $nome, $cognome, $email, $password);
    unset($db);
}catch(Exception $e) {
    header("Location: ./error500.php");
    exit;
}

if($register_result) {
    $_SESSION['user_id'] = $register_result['id'];
    $_SESSION['username'] = $register_result['username'];
    $_SESSION['nome'] = $register_result['nome'];
    $_SESSION['cognome'] = $register_result['cognome'];
    $_SESSION['ruolo'] = $register_result['ruolo'];
    header("Location: profile_schede.php");
    exit;
} else {
    $_SESSION["error"] = "Errore interno durante la registrazione.";
    header("Location: register.php");
    exit;
}
?>