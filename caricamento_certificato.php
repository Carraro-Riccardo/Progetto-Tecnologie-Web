<?php

session_start();
require_once("./db_handler.php");

if(!isset($_SESSION["user_id"])){
    $_SESSION['error'] = "Devi prima effettuare il login.";
    header("Location: ./login.php");
    exit;
}

if(isset($_FILES['certificato'])){
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mime = finfo_file($finfo, $_FILES['certificato']['tmp_name']);
    if($mime != 'application/pdf'){
        finfo_close($finfo);
        $_SESSION['error'] = "Il file caricato non è un PDF.";
        header("Location: ./profile_certificato.php");
        exit;
    }
} else {
    $_SESSION['error'] = "Devi prima caricare un certificato.";
    header("Location: ./profile_certificato.php");
    exit;
}


if(isset($_SESSION["user_id"])){
    try {
        $db = new Database();
        $certificato_result = $db->getCertificatoUtente($_SESSION['user_id']);

        if($certificato_result){
            $certificato_result = $certificato_result->fetch_assoc();
            unlink($certificato_result["certificatoPath"]);
        }

        $new_path = "./certificati/" . "certificato_" . $_SESSION["user_id"] . ".pdf";
        move_uploaded_file($_FILES["certificato"]["tmp_name"], $new_path);
        $db->insertCertificato($_SESSION["user_id"], $new_path);
        
        unset($db);
        $_SESSION['success'] = "Certificato caricato con successo.";
        header("Location: ./profile_certificato.php");
        exit;
    }catch(Exception $e) {
        header("Location: ./error500.php");
        exit;
    }
}

?>