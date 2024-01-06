<?php
session_start();
require_once("db_handler.php");

function checkUsername($username) {
    $usernameRegex = "/^[A-Za-z]+$/";
    $usernameLength = 50;

    if (empty($username)) {
        return "Lo <span lang='en'>username</span> non può essere vuoto.";
    } else if (!preg_match($usernameRegex, $username)) {
        return "Lo <span lang='en'>username</span> può contenere solo caratteri (maiuscoli e minuscoli).";
    } else if (strlen($username) > $usernameLength) {
        return "Lo <span lang='en'>username</span> non può eccedere i " . $usernameLength . " caratteri).";
    }

    return "";
}

function checkPassword($password) {
    $passwordLength = 255;

    if (empty($password)) {
        return "La <span lang='en'>password</span> non può essere vuota.";
    } else if (strlen($password) > $passwordLength) {
        return "La <span lang='en'>password</span> non può eccedere i " . $passwordLength . " caratteri.";
    }

    return "";
}

if (isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}

$username = isset($_POST['username']) ? $_POST['username'] : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';

$usernameError = checkUsername($username);
$passwordError = checkPassword($password);

if (!empty($usernameError) || !empty($passwordError)) {
    $_SESSION["error"] = $usernameError . $passwordError;
    header("Location: login.php");
    exit();
}

try {
    $db = new Database();
    $login_result = $db->login($username, $password);
    unset($db);
}catch(Exception $e) {
    $_SESSION["error"] = "Errore interno.";
    header("Location: login.php");
    exit;
}

if($login_result) {
    session_start();
    $_SESSION['user_id'] = $login_result['id'];
    $_SESSION['username'] = $login_result['username'];
    $_SESSION['ruolo'] = $login_result['ruolo'];
    header("Location: profile_schede.php");
    exit;
} else {
    $_SESSION["error"] = "Credenziali errate.";
    header("Location: login.php");
    exit;
}

?>