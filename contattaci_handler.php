<?php
    session_start();
    require_once("./pages_builder.php");
    require_once("./server_side_validator.php");

    $firstName = isset($_POST['firstName']) ? $_POST['firstName'] : '';
    $lastName = isset($_POST['lastName']) ? $_POST['lastName'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $message = isset($_POST['message']) ? $_POST['message'] : '';

    $firstNameError = checkNome($firstName);
    $lastNameError = checkCognome($lastName);
    $emailError = checkEmail($email);
    $messageError = checkMessage($message);

    if (!empty($firstNameError) || !empty($lastNameError) || !empty($emailError) || !empty($messageError)){
        $_SESSION["error"] = $usernameError . $lastNameError . $emailError . $messageError;
        header("Location: contattaci.php");
        exit();
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $firstName = $_POST["firstName"];
        $lastName = $_POST["lastName"];
        $email = $_POST["email"];
        $message = $_POST["message"];
        $to = "gaggym24@gmail.com";
        $subject = "Nuovo messaggio dal form di contatto";
        $body = "Nome: $firstName\nCognome: $lastName\nEmail: $email\nMessaggio: $message";
        if (mail($to, $subject, $body)) {
            $_SESSION["success"]="Messaggio inviato con successo.";
            header("Location: contattaci.php");
            exit();
        } else {
            $_SESSION["error"]="ERRORE nell'invio del messaggio.";
            header("Location: contattaci.php");
            exit();
        }
    } 
?>

