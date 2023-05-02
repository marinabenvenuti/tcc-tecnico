<?php

include('conexao.php');

$cod_questao = $_GET['cod_questao'];

$sql = "DELETE FROM questao WHERE cod_questao=$cod_questao";

mysqli_query($conn, $sql);
if (mysqli_affected_rows($conn) > 0) {
    header("Location: listaquestoes.php");
} else {
    echo "<script>alert('Houve algum erro.');</script>";
    mysqli_error($conn);
    echo $conn->error;
}
?>
