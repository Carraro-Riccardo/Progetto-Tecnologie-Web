<?php
include "./libs/phpqrcode/qrlib.php";

session_start();
if(isset($_SESSION["user_id"])){
    return QRcode::png($_SESSION["user_id"], false, QR_ECLEVEL_L, 6);
}else{
    $_SESSION['error'] = "Necessario effettuare il <span lang='en'>login</span> per accedere alla pagina.";
    header("Location: login.php?error=notloggedin");
    exit;
}
?>