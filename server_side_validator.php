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
        return "Il campo <span lang='en'>email</span> non può essere vuoto.";
    } else if (!preg_match($emailRegex, $email)) {
        return "Il campo <span lang='en'>email</span> deve essere un email valido.";
    } else if (strlen($email) > $emailLength) {
        return "Il campo <span lang='en'>email</span> non può superare " . $emailLength . " caratteri.";
    }

    return "";
}

function checkPassword($password) {
    $passwordLength = 255;

    if (empty($password)) {
        return "Il campo <span lang='en'>password</span> non può essere vuoto.";
    } else if (strlen($password) > $passwordLength) {
        return "Il campo <span lang='en'>password</span> non può superare " . $passwordLength . " caratteri.";
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

function checkMessage($message) {
    $messageLength = 1000;

    if (empty($message)) {
        return "Il campo messaggio non può essere vuoto.";
    } else if (strlen($message) > $messageLength) {
        return "Il campo messaggio non può superare " . $messageLength . " caratteri.";
    }
  
  return "";
  
}

function checkCardNumber($cardNumber) {
    $cardNumberRegex = "/^[0-9]{16}$/";

    if (empty($cardNumber)) {
        return "Il campo numero carta non può essere vuoto.\n";
    } else if (!preg_match($cardNumberRegex, $cardNumber)) {
        return "Il campo numero carta deve contenere solo 16 cifre.\n";
    }

    return "";
}

function checkDataScadenza($dataScadenza) {
    $dataScadenzaRegex = "/^(0[1-9]|1[0-2])\/[0-9]{2}$/";

    if (empty($dataScadenza)) {
        return "Il campo data scadenza non può essere vuoto.\n";
    } else if (!preg_match($dataScadenzaRegex, $dataScadenza)) {
        return "La data di scadenza deve essere valida e nel formato MM/AA.\n";
    } else {
        list($month, $year) = explode('/', $dataScadenza);
        
        $currentYear = date('y');
        $currentMonth = date('m');
        
        if ($year < $currentYear || ($year == $currentYear && $month <= $currentMonth)) {
            return "La data di scadenza deve essere nel futuro.\n";
        }
    }

    return "";
}

function checkDataScadenzaCertificato($data) {
    $dateParts = explode("/", $data);

    if (count($dateParts) === 3 && strlen($dateParts[0]) === 2 && strlen($dateParts[1]) === 2 && strlen($dateParts[2]) === 4) {
        $day = intval($dateParts[0]);
        $month = intval($dateParts[1]);
        $year = intval($dateParts[2]);

        if (checkdate($month, $day, $year)) {
            $date = new DateTime($year . '-' . $month . '-' . $day);
            $today = new DateTime();

            if ($date > $today) {
                return "";
            } else {
                return "Data non valida, deve essere una data futura.";
            }
        } else {
            return "Data inserita non valida";
        }
    } else {
        return "Il formato della data non è corretto: deve essere GG/MM/AAAA";
    }
}


function checkCvv($cvv) {
    $cvvRegex = "/^[0-9]{3}$/";

    if (empty($cvv)) {
        return "Il campo CVV non può essere vuoto.";
    } else if (!preg_match($cvvRegex, $cvv)) {
        return "Il campo CVV deve contenere solo 3 cifre.";
    }

    return "";
}

?>