<?php
session_start();
require_once("db_handler.php");
require_once("server_side_validator.php");

if (isset($_SESSION['user_id'])) {
    header((isset($_SESSION["ruolo"]) && $_SESSION["ruolo"] == "user")? "Location: ./profile_profilo.php" : "Location: ./admin_landing.php");
    exit;
}

$username = isset($_POST['username']) ? $_POST['username'] : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';

$usernameError = checkUsername($username);
$passwordError = checkPassword($password);

if (!empty($usernameError) || !empty($passwordError)) {
    $_SESSION["error"] = $usernameError . $passwordError;
    header("Location: ./login.php");
    exit();
}

try {
    $db = new Database();
    $login_result = $db->login($username, $password);
    unset($db);
}catch(Exception $e) {
    $_SESSION["error"] = "Errore interno.";
    header("Location: ./login.php");
    exit;
}

if($login_result) {
    session_start();
    $_SESSION['user_id'] = $login_result['username'];
    $_SESSION['ruolo'] = $login_result['ruolo'];

    if(isset($_SESSION["redirect_to"])){
        header("Location: ".$_SESSION["redirect_to"]);
        unset($_SESSION["redirect_to"]);
        exit;
    }

    header(($login_result['ruolo'] == "user")? "Location: ./profile_profilo.php" : "Location: ./admin_landing.php");
    exit;
} else {
    $_SESSION["error"] = "Credenziali errate.";
    header("Location: ./login.php");
    exit;
}

?>