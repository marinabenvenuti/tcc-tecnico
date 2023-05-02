<?php
include("conexao.php"); // inclui o arquivo de conexão com BD

$nome = $_POST['nome'];
$emai = $_POST['email'];
$senha = $_POST['senha'];

$sql = "INSERT INTO usuarios (nome, email, senha) 
        VALUES ('$nome', '$email', '$senha')";
mysqli_query($conn, $sql);

mysqli_close($conn);
echo "cadastrado com sucesso.";