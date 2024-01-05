<?php

require_once("db_handler.php");

if (isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}

$username = isset($_POST['username']) ? $_POST['username'] : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';

if (empty($username) || empty($password)) {
    header("Location: login.php?error=emptyfields");
    exit;
}

try {
    $db = new Database();
    $login_result = $db->login($username, $password);
    unset($db);
}catch(Exception $e) {
    header("Location: login.php?error=sqlerror");
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
    header("Location: login.php?error=wrongcredentials");
    exit;
}

?>