<?php 

function checkUsername($username) {
    $usernameRegex = "/^[A-Za-z]+$/";
    $usernameLength = 50;

    if (empty($username)) {
        return "Il campo <span lang='en'>username</span> non può essere vuoto.";
    } else if (!preg_match($usernameRegex, $username)) {
        return "Il campo <span lang='en'>username</span> può contenere solo caratteri (sia maiuscoli che minuscoli).";
    } else if (strlen($username) > $usernameLength) {
        return "Il campo <span lang='en'>username</span> non può superare " . $usernameLength . " caratteri.";
    }

    return "";
}

function checkNome($nome) {
    $nomeRegex = "/^[A-Za-z\s]+$/";
    $nomeLength = 30;

    if (empty($nome)) {
        return "Il campo nome non può essere vuoto.";
    } else if (!preg_match($nomeRegex, $nome)) {
        return "Il campo nome può contenere solo caratteri (sia maiuscoli che minuscoli) e spazi.";
    } else if (strlen($nome) > $nomeLength) {
        return "Il campo nome non può superare " . $nomeLength . " caratteri.";
    }

    return "";
}

function checkCognome($cognome) {
    $cognomeRegex = "/^[A-Za-z\s]+$/";
    $cognomeLength = 30;

    if (empty($cognome)) {
        return "Il campo cognome non può essere vuoto.";
    } else if (!preg_match($cognomeRegex, $cognome)) {
        return "Il campo cognome può contenere solo caratteri (sia maiuscoli che minuscoli) e spazi.";
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

function checkRegisterPassword($password, $confirmPassword) {
    $passwordLength = 255;

    if (empty($password)) {
        return "Il campo <span lang='en'>password</span> non può essere vuoto.";
    } else if (strlen($password) > $passwordLength) {
        return "Il campo <span lang='en'>password</span> non può superare " . $passwordLength . " caratteri.";
    } else if ($password !== $confirmPassword) {
        return "Il campo <span lang='en'>password</span> e il campo conferma password devono corrispondere.";
    }

    return "";
}

?>