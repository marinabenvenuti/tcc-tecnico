<?php

include('conexao.php');

$cod_pergunta = $_GET['cod_pergunta'];

$sql = "DELETE FROM perguntas WHERE cod_pergunta=$cod_pergunta";

mysqli_query($conn, $sql);
if (mysqli_affected_rows($conn) > 0) {
    header("Location: listaperguntasforum.php");
} else {
    echo "<script>alert('Houve algum erro.');</script>";
    mysqli_error($conn);
    echo $conn->error;
}
?>