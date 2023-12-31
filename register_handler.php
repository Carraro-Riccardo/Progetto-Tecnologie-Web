<?php

require_once("db_handler.php");

if (isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}

$username = isset($_POST['username']) ? $_POST['username'] : '';
$email = isset($_POST['email']) ? $_POST['email'] : '';
$confirmEmail = isset($_POST['confirmEmail']) ? $_POST['confirmEmail'] : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';

if (empty($username) || empty($email) || empty($confirmEmail) || empty($password)) {
    header("Location: register.php?error=emptyfields");
    exit;
}

if($email != $confirmEmail) {
    header("Location: register.php?error=emailsDontMatch");
    exit;
}

try {
    $db = new Database();
    $register_result = $db->register($username, $email, $password);
    unset($db);
}catch(Exception $e) {
    header("Location: register.php?error=sqlerror");
    exit;
}

if($register_result) {
    session_start();
    $_SESSION['user_id'] = $register_result['id'];
    $_SESSION['username'] = $register_result['username'];
    $_SESSION['ruolo'] = $register_result['ruolo'];
    header("Location: profile.php");
    exit;
} else {
    header("Location: register.php?error=erroreDuranteLaRegistrazione");
    exit;
}
?>