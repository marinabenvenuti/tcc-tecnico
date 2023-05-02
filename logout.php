<?php
session_start();

unset($_SESSION["email_logado"]);
header('location: cadastrousuario.php');
exit;
?>