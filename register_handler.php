<?php

require_once("db_handler.php");

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

if (empty($username) || empty($nome) || empty($cognome) || empty($email) || empty($password) || empty($confirmPassword)) {
    header("Location: register.php?error=emptyfields");
    exit;
}

if($password != $confirmPassword) {
    header("Location: register.php?error=passwordDoesNotMatch");
    exit;
}

try {
    $db = new Database();
    $register_result = $db->register($username, $nome, $cognome, $email, $password);
    unset($db);
}catch(Exception $e) {
    header("Location: register.php?error=sqlerror");
    exit;
}

if($register_result) {
    session_start();
    $_SESSION['user_id'] = $register_result['id'];
    $_SESSION['username'] = $register_result['username'];
    $_SESSION['nome'] = $register_result['nome'];
    $_SESSION['cognome'] = $register_result['cognome'];
    $_SESSION['ruolo'] = $register_result['ruolo'];
    header("Location: profile_schede.php");
    exit;
} else {
    header("Location: register.php?error=erroreDuranteLaRegistrazione");
    exit;
}
?>