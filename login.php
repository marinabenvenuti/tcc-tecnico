<?php
session_start();
include("conexao.php"); // inclui o arquivo de conexão com BD

$emailuser = $_POST['email'];
$senhauser = $_POST['senha'];
$sql = "SELECT * from usuarios where email = '$emailuser' AND senha = '$senhauser'";
$result = mysqli_query($conn, $sql);

if (mysqli_affected_rows($conn) > 0) {
    header("location: paginainicial.php");
    exit;
} else {
    echo "<script>alert('erro')</script>";
    header('Refresh: 0;url=cadastrousuario.php');
}
