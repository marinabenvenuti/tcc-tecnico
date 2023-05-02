<?php

include('conexao.php');

$cod_usuario = $_GET['cod_usuario'];

$sql = "UPDATE usuarios SET is_admin=!(select is_admin from usuarios where cod_usuario=$cod_usuario) WHERE cod_usuario=$cod_usuario";

mysqli_query($conn, $sql);
if (mysqli_affected_rows($conn) > 0) {
    header("Location: listausuarios.php");
} else {
    echo "<script>alert('Houve algum erro.');</script>";
    mysqli_error($conn);
    echo $conn->error;
}
?>
