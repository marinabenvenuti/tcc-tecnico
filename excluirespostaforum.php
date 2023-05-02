<?php

include('conexao.php');

$cod_resposta = $_GET['cod_resposta'];

$sql = "DELETE FROM respostas WHERE cod_resposta=$cod_resposta";

mysqli_query($conn, $sql);
if (mysqli_affected_rows($conn) > 0) {
    header("Location: listarespostasforum.php");
} else {
    echo "<script>alert('Houve algum erro.');</script>";
    mysqli_error($conn);
    echo $conn->error;
}
?>