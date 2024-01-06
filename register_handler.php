<?php
session_start();
require_once("db_handler.php");

if (isset($_SESSION['user_id'])) {
    header("Location: profile.php");
    exit;
}

function checkUsername($username) {
    $usernameRegex = "/^[A-Za-z]+$/";
    $usernameLength = 50;

    if (empty($username)) {
        return "Il campo username non può essere vuoto.";
    } else if (!preg_match($usernameRegex, $username)) {
        return "Il campo username può contenere solo caratteri (sia maiuscoli che minuscoli).";
    } else if (strlen($username) > $usernameLength) {
        return "Il campo username non può superare " . $usernameLength . " caratteri.";
    }

    return "";
}

function checkNome($nome) {
    $nomeRegex = "/^[A-Za-z]+$/";
    $nomeLength = 30;

    if (empty($nome)) {
        return "Il campo nome non può essere vuoto.";
    } else if (!preg_match($nomeRegex, $nome)) {
        return "Il campo nome può contenere solo caratteri (sia maiuscoli che minuscoli).";
    } else if (strlen($nome) > $nomeLength) {
        return "Il campo nome non può superare " . $nomeLength . " caratteri.";
    }

    return "";
}

function checkCognome($cognome) {
    $cognomeRegex = "/^[A-Za-z]+$/";
    $cognomeLength = 30;

    if (empty($cognome)) {
        return "Il campo cognome non può essere vuoto.";
    } else if (!preg_match($cognomeRegex, $cognome)) {
        return "Il campo cognome può contenere solo caratteri (sia maiuscoli che minuscoli).";
    } else if (strlen($cognome) > $cognomeLength) {
        return "Il campo cognome non può superare " . $cognomeLength . " caratteri.";
    }

    return "";
}

function checkEmail($email) {
    $emailRegex = "/^[^\s@]+@[^\s@]+\.[^\s@]+$/";
    $emailLength = 50;

    if (empty($email)) {
        return "Il campo email non può essere vuoto.";
    } else if (!preg_match($emailRegex, $email)) {
        return "Il campo email deve essere un email valido.";
    } else if (strlen($email) > $emailLength) {
        return "Il campo email non può superare " . $emailLength . " caratteri.";
    }

    return "";
}

function checkPassword($password, $confirmPassword) {
    $passwordLength = 255;

    if (empty($password)) {
        return "Il campo password non può essere vuoto.";
    } else if (strlen($password) > $passwordLength) {
        return "Il campo password non può superare " . $passwordLength . " caratteri.";
    } else if ($password !== $confirmPassword) {
        return "Il campo password e il campo conferma password devono corrispondere.";
    }

    return "";
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
$passwordError = checkPassword($password, $confirmPassword);

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
    $_SESSION["error"] = "Errore interno.";
    header("Location: register.php?error=sqlerror");
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